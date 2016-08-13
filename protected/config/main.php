<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Temples Unlimited',
	'defaultController' => 'front',
          'timeZone' => 'Asia/Calcutta',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.easyimage.EasyImage',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	
		    'front',
	),

	// application components
	'components'=>array(
	
	'hybridAuth'=>array(
            'class'=>'ext.widgets.hybridAuth.CHybridAuth',
            'enabled'=>true, // enable or disable this component
            'config'=>array(
                 "base_url" => "http://livedemo.blazewebtech.com/temples_new/index.php/front/hybridauth/endpoint", 
                 "providers" => array(
                       "Google" => array(
                            "enabled" => true,
                            "keys" => array("id" => "80123545716-j2i1s871folr8q0mnrj3nl18c4qq1v56.apps.googleusercontent.com", "secret" => "EtQL8Sj1ZDoWIY09_fmpYpq-"),
                        ),
                       //"Facebook" => array(
                       //     "enabled" => true,
                      //      "keys" => array("id" => "510783399036132", "secret" => "1cfcd6b3d140f1e87c0d8b79bbdeb764"),
                      //  ),
                       "Facebook" => array(
                            "enabled" => true,
                          "keys" => array("id" => "714655325283643", "secret" => "13c0048592e96dedc4f663db7212978e"),
                             // "keys" => array("id" => "510783399036132", "secret" => "1cfcd6b3d140f1e87c0d8b79bbdeb764"),
                       ),
                     //  "Twitter" => array(
//"enabled" => true,
                        //    "keys" => array("key" => "dZiMkFgfUFPUBCo7IS23JXvdk", "secret" => "x1NSF6mJKDVjc1x6MtEcC1yevVUR2NxC47jZRU6KSDcFx4HUPH")
                     //  ),
					     "Twitter" => array(
                            "enabled" => true,
                            "keys" => array("key" => "4rJfn3qRkUD94XcuqRXsMjMmP", "secret" => "wh3frqa4OCAMANB1DArTxZ4dkmBBYEZuKVy7URFUJkWN8jrT9d")
                       ),
					  "LinkedIn" => array(
                            "enabled" => true,
                            "keys" => array("key" => "75zki69rpmpn8r", "secret" => "3YQlX51gC9DMyizT")
                       ),
                 ),
                 "debug_mode" => false,
                 "debug_file" => "",
             ),
         ),//end hybridAuth
		 
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				        '<action:(front|default|login)>' => 'front/default/login',
						'<action:(front|list|news)>' => 'front/list/news',
						'<action:(front|list|events)>' => 'front/list/events',
						'<action:(front|list|products)>' => 'front/list/products',
						'<action:(front|list|epooja)>' => 'front/list/epooja',
						'<action:(front|profile|user)>' => 'front/profile/user',
						'' => 'front',
						'<action:(front|user|regsuccess)>' => 'front/user/regsuccess',
						'<action:(front|default|login|type|social)>' =>'front/default/login/type/social',
						'<action:(front|user|create)>' => 'front/user/create',
						'<action:(front|default|forgot)>' => 'front/default/forgot', 
					    '<action:(front|profile|password)>' =>'front/profile/password',
						'<action:(front|profile|reviews)>'=>'front/profile/reviews',
					    '<action:(front|profile|favourites)>'=>'/front/profile/favourites',
						'<action:(front|profile|photos)>'=>'front/profile/photos',
						'<action:(front|profile|cart)>'=>'front/profile/cart',
						'<action:(front|profile|orders)>'=>'front/profile/orders',
						'<action:(front|profile|logout)>'=>'/front/default/logout',
						'<action:(front|profile|guideplan)>'=>'/front/profile/guideplan',
						'<action:(front|profile|poojas)>'=>'/front/profile/poojas',
						'<action:(front|profile|certificates)>'=>'front/profile/certificates',
						'<action:(front|auto|blog)>'=>'front/auto/blog',
						'<action:(front|default|term)>'=>'front/default/term',
						'<action:(front|default|about)>'=>'front/default/about',
						'<action:(front|default|contact)>'=>'front/default/contact',
						'<action:(front|default|howitworks)>'=>'front/default/howitworks',
						'<action:(front|list|temples)>'=>'front/list/temples',
						'<action:(front|auto|iyernew)>'=>'front/auto/iyernew',
						'<action:(front|list|guide)>'=>'front/list/guide',
                                                '<action:(front|detail|iyer)>'=>'front/detail/iyer',
                                                '<action:(front|profile|orderig)>'=>'front/profile/orderig',


						
			),
		),
		
		'phpThumb'=>array(
        'class'=>'application.extensions.EPhpThumb.EPhpThumb',
         ),
  
		 
		
	/*	'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=livedemo_temples_new',
			'emulatePrepare' => true,
			'username' => 'livedemo_ability',
			'password' => 'ability',
			'charset' => 'utf8',
		),
		
		/*'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=livedemo_temples_new',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'blaze.ws',
			'charset' => 'utf8',
		),*/
		
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'front/default/error',
		),
		
		
		
		
		'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
			'Mailer'=>'mail',
            'Host'=>"",
			'SMTPAuth'=>true, 
            'Username'=>'',
            'Password'=>'',  
           
            
        ),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),
	

		

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	/*'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),*/
	'params'=>require(dirname(__FILE__).'/params.php'),
);
?>