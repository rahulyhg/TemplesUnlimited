<?php
// http://gitorious.org/lightopenid
// 20/11/11

/**
 * This class provides a simple interface for OpenID (1.1 and 2.0) authentication.
 * Supports Yadis discovery. 
 * The library requires PHP >= 5.1.2 with curl or http/https stream wrappers enabled.
 * @author Mewp
 * @copyright Copyright (c) 2010, Mewp
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class LightOpenID
{
    public $returnUrl
         , $required = array()
         , $optional = array()
         , $verify_peer = null
         , $capath = null
         , $cainfo = null
         , $data;
    private $identity, $claimed_id;
    protected $server, $version, $trustRoot, $aliases, $identifier_select = false
            , $ax = false, $sreg = false, $setup_url = null, $headers = array();
    static protected $ax_to_sreg = array(
        'namePerson/friendly'     => 'nickname',
        'contact/email'           => 'email',
        'namePerson'              => 'fullname',
        'birthDate'               => 'dob',
        'person/gender'           => 'gender',
        'contact/postalCode/home' => 'postcode',
        'contact/country/home'    => 'country',
        'pref/language'           => 'language',
        'pref/timezone'           => 'timezone',
        );

    function __construct($host)
    {
        $this->trustRoot = (strpos($host, '://') ? $host : 'http://' . $host);
        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
            && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        ) {
            $this->trustRoot = (strpos($host, '://') ? $host : 'https://' . $host);
        }

        if(($host_end = strpos($this->trustRoot, '/', 8)) !== false) {
            $this->trustRoot = substr($this->trustRoot, 0, $host_end);
        }

        $uri = rtrim(preg_replace('#((?<=\?)|&)openid\.[^&]+#', '', $_SERVER['REQUEST_URI']), '?');
        $this->returnUrl = $this->trustRoot . $uri;

        $this->data = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;

        if(!function_exists('curl_init') && !in_array('https', stream_get_wrappers())) {
            throw new ErrorException('You must have either https wrappers or curl enabled.');
        }
    }

    function __set($name, $value)
    {
        switch ($name) {
        case 'identity':
            if (strlen($value = trim((String) $value))) {
                if (preg_match('#^xri:/*#i', $value, $m)) {
                    $value = substr($value, strlen($m[0]));
                } elseif (!preg_match('/^(?:[=@+\$!\(]|https?:)/i', $value)) {
                    $value = "http://$value";
                }
                if (preg_match('#^https?://[^/]+$#i', $value, $m)) {
                    $value .= '/';
                }
            }
            $this->$name = $this->claimed_id = $value;
            break;
        case 'trustRoot':
        case 'realm':
            $this->trustRoot = trim($value);
        }
    }

    function __get($name)
    {
        switch ($name) {
        case 'identity':
            # We return claimed_id instead of identity,
            # because the developer should see the claimed identifier,
            # i.e. what he set as identity, not the op-local identifier (which is what we verify)
            return $this->claimed_id;
        case 'trustRoot':
        case 'realm':
            return $this->trustRoot;
        case 'mode':
            return empty($this->data['openid_mode']) ? null : $this->data['openid_mode'];
        }
    }

    /**
     * Checks if the server specified in the url exists.
     *
     * @param $url url to check
     * @return true, if the server exists; false otherwise
     */
    function hostExists($url)
    {
        if (strpos($url, '/') === false) {
            $server = $url;
        } else {
            $server = @parse_url($url, PHP_URL_HOST);
        }

        if (!$server) {
            return false;
        }

        return !!gethostbynamel($server);
    }

    protected function request_curl($url, $method='GET', $params=array(), $update_claimed_id)
    {
        $params = http_build_query($params, '', '&');
        $curl = curl_init($url . ($method == 'GET' && $params ? '?' . $params : ''));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/xrds+xml, */*'));

        if($this->verify_peer !== null) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->verify_peer);
            if($this->capath) {
                curl_setopt($curl, CURLOPT_CAPATH, $this->capath);
            }

            if($this->cainfo) {
                curl_setopt($curl, CURLOPT_CAINFO, $this->cainfo);
            }
        }

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        } elseif ($method == 'HEAD') {
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_NOBODY, true);
        } else {
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_HTTPGET, true);
        }
        $response = curl_exec($curl);

        if($method == 'HEAD' && curl_getinfo($curl, CURLINFO_HTTP_CODE) == 405) {
            curl_setopt($curl, CURLOPT_HTTPGET, true);
            $response = curl_exec($curl);
            $response = substr($response, 0, strpos($response, "\r\n\r\n"));
        }

        if($method == 'HEAD' || $method == 'GET') {
            $header_response = $response;

            # If it's a GET request, we want to only parse the header part.
            if($method == 'GET') {
                $header_response = substr($response, 0, strpos($response, "\r\n\r\n"));
            }

            $headers = array();
            foreach(explode("\n", $header_response) as $header) {
                $pos = strpos($header,':');
                if ($pos !== false) {
                    $name = strtolower(trim(substr($header, 0, $pos)));
                    $headers[$name] = trim(substr($header, $pos+1));
                }
            }

            if($update_claimed_id) {
                # Updating claimed_id in case of redirections.
                $effective_url = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
                if($effective_url != $url) {
                    $this->identity = $this->claimed_id = $effective_url;
                }
            }

            if($method == 'HEAD') {
                return $headers;
            } else {
                $this->headers = $headers;
            }
        }

        if (curl_errno($curl)) {
            throw new ErrorException(curl_error($curl), curl_errno($curl));
        }

        return $response;
    }

    protected function parse_header_array($array, $update_claimed_id)
    {
        $headers = array();
        foreach($array as $header) {
            $pos = strpos($header,':');
            if ($pos !== false) {
                $name = strtolower(trim(substr($header, 0, $pos)));
                $headers[$name] = trim(substr($header, $pos+1));

                # Following possible redirections. The point is just to have
                # claimed_id change with them, because the redirections
                # are followed automatically.
                # We ignore redirections with relative paths.
                # If any known provider uses them, file a bug report.
                if($name == 'location' && $update_claimed_id) {
                    if(strpos($headers[$name], 'http') === 0) {
                        $this->identity = $this->claimed_id = $headers[$name];
                    } elseif($headers[$name][0] == '/') {
                        $parsed_url = parse_url($this->claimed_id);
                        $this->identity =
                        $this->claimed_id = $parsed_url['scheme'] . '://'
                                          . $parsed_url['host']
                                          . $headers[$name];
                    }
                }
            }
        }
        return $headers;
    }

    protected function request_streams($url, $method='GET', $params=array(), $update_claimed_id)
    {
        if(!$this->hostExists($url)) {
            throw new ErrorException("Could not connect to $url.", 404);
        }

        $params = http_build_query($params, '', '&');
        switch($method) {
        case 'GET':
            $opts = array(
                'http' => array(
                    'method' => 'GET',
                    'header' => 'Accept: application/xrds+xml, */*',
                    'ignore_errors' => true,
                ), 'ssl' => array(
                    'CN_match' => parse_url($url, PHP_URL_HOST),
                ),
            );
            $url = $url . ($params ? '?' . $params : '');
            break;
        case 'POST':
            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $params,
                    'ignore_errors' => true,
                ), 'ssl' => array(
                    'CN_match' => parse_url($url, PHP_URL_HOST),
                ),
            );
            break;
        case 'HEAD':
            # We want to send a HEAD request,
            # but since get_headers doesn't accept $context parameter,
            # we have to change the defaults.
            $default = stream_context_get_options(stream_context_get_default());
            stream_context_get_default(
                array(
                    'http' => array(
                        'method' => 'HEAD',
                        'header' => 'Accept: application/xrds+xml, */*',
                        'ignore_errors' => true,
                    ), 'ssl' => array(
                        'CN_match' => parse_url($url, PHP_URL_HOST),
                    ),
                )
            );

            $url = $url . ($params ? '?' . $params : '');
            $headers = get_headers ($url);
            if(!$headers) {
                return array();
            }

            if(intval(substr($headers[0], strlen('HTTP/1.1 '))) == 405) {
                # The server doesn't support HEAD, so let's emulate it with
                # a GET.
                $args = func_get_args();
                $args[1] = 'GET';
                call_user_func_array(array($this, 'request_streams'), $args);
                return $this->headers;
            }

            $headers = $this->parse_header_array($headers, $update_claimed_id);

            # And restore them.
            stream_context_get_default($default);
            return $headers;
        }

        if($this->verify_peer) {
            $opts['ssl'] += array(
                'verify_peer' => true,
                'capath'      => $this->capath,
                'cafile'      => $this->cainfo,
            );
        }

        $context = stream_context_create ($opts);
        $data = file_get_contents($url, false, $context);
        # This is a hack for providers who don't support HEAD requests.
        # It just creates the headers array for the last request in $this->headers.
        if(isset($http_response_header)) {
            $this->headers = $this->parse_header_array($http_response_header, $update_claimed_id);
        }

        return file_get_contents($url, false, $context);
    }

    protected function request($url, $method='GET', $params=array(), $update_claimed_id=false)
    {
        if (function_exists('curl_init')
            && (!in_array('https', stream_get_wrappers()) || !ini_get('safe_mode') && !ini_get('open_basedir'))
        ) {
            return $this->request_curl($url, $method, $params, $update_claimed_id);
        }
        return $this->request_streams($url, $method, $params, $update_claimed_id);
    }

    protected function build_url($url, $parts)
    {
        if (isset($url['query'], $parts['query'])) {
            $parts['query'] = $url['query'] . '&' . $parts['query'];
        }

        $url = $parts + $url;
        $url = $url['scheme'] . '://'
             . (empty($url['username'])?''
                 :(empty($url['password'])? "{$url['username']}@"
                 :"{$url['username']}:{$url['password']}@"))
             . $url['host']
             . (empty($url['port'])?'':":{$url['port']}")
             . (empty($url['path'])?'':$url['path'])
             . (empty($url['query'])?'':"?{$url['query']}")
             . (empty($url['fragment'])?'':"#{$url['fragment']}");
        return $url;
    }

    /**
     * Helper function used to scan for <meta>/<link> tags and extract information
     * from them
     */
    protected function htmlTag($content, $tag, $attrName, $attrValue, $valueName)
    {
        preg_match_all("#<{$tag}[^>]*$attrName=['\"].*?$attrValue.*?['\"][^>]*$valueName=['\"](.+?)['\"][^>]*/?>#i", $content, $matches1);
        preg_match_all("#<{$tag}[^>]*$valueName=['\"](.+?)['\"][^>]*$attrName=['\"].*?$attrValue.*?['\"][^>]*/?>#i", $content, $matches2);

        $result = array_merge($matches1[1], $matches2[1]);
        return empty($result)?false:$result[0];
    }

    /**
     * Performs Yadis and HTML discovery. Normally not used.
     * @param $url Identity URL.
     * @return String OP Endpoint (i.e. OpenID provider address).
     * @throws ErrorException
     */
    function discover($url)
    {
        if (!$url) throw new ErrorException('No identity supplied.');
        # Use xri.net proxy to resolve i-name identities
        if (!preg_match('#^https?:#', $url)) {
            $url = "https://xri.net/$url";
        }

        # We save the original url in case of Yadis discovery failure.
        # It can happen when we'll be lead to an XRDS document
        # which does not have any OpenID2 services.
        $originalUrl = $url;

        # A flag to disable yadis discovery in case of failure in headers.
        $yadis = true;

        # We'll jump a maximum of 5 times, to avoid endless redirections.
        for ($i = 0; $i < 5; $i ++) {
            if ($yadis) {
                $headers = $this->request($url, 'HEAD', array(), true);

                $next = false;
                if (isset($headers['x-xrds-location'])) {
                    $url = $this->build_url(parse_url($url), parse_url(trim($headers['x-xrds-location'])));
                    $next = true;
                }

                if (isset($headers['content-type'])
                    && (strpos($headers['content-type'], 'application/xrds+xml') !== false
                        || strpos($headers['content-type'], 'text/xml') !== false)
                ) {
                    # Apparently, some providers return XRDS documents as text/html.
                    # While it is against the spec, allowing this here shouldn't break
                    # compatibility with anything.
                    # ---
                    # Found an XRDS document, now let's find the server, and optionally delegate.
                    $content = $this->request($url, 'GET');

                    preg_match_all('#<Service.*?>(.*?)</Service>#s', $content, $m);
                    foreach($m[1] as $content) {
                        $content = ' ' . $content; # The space is added, so that strpos doesn't return 0.

                        # OpenID 2
                        $ns = preg_quote('http://specs.openid.net/auth/2.0/', '#');
                        if(preg_match('#<Type>\s*'.$ns.'(server|signon)\s*</Type>#s', $content, $type)) {
                            if ($type[1] == 'server') $this->identifier_select = true;

                            preg_match('#<URI.*?>(.*)</URI>#', $content, $server);
                            preg_match('#<(Local|Canonical)ID>(.*)</\1ID>#', $content, $delegate);
                            if (empty($server)) {
                                return false;
                            }
                            # Does the server advertise support for either AX or SREG?
                            $this->ax   = (bool) strpos($content, '<Type>http:/