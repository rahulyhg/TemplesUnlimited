<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'TemplesUnLimited',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
	
	'vehiclearr'=>array("Car"=>'Car',"Bus"=>"Bus","Van"=>"Van","Lorry"=>'Lorry',"Motor-cycle"=>"Motor-cycle","Ship"=>"Ship","Others"=>"Others"),
	
	'userrolearr'=>array("1"=>'Admin',"2"=>"Normal User","3"=>"Guide","4"=>'Iyer'),
	'usertype'=>array("1"=>'Admin',"2"=>"Normal User","3"=>"guide","4"=>'iyer'),
	
	'phone_begin'=>'+',
	
	'currency_symbol'=>'Rs. ',
	'upgrade_amount'=>'10',
	
	'SITE_BASE_URL'=>'http://livedemo.blazewebtech.com/temples_new',
	
	'ALLOWED_IMAGE_TYPE'=>array('image/jpeg', 'image/gif','image/jpg','image/png','image/bmp', 'application/pdf'),	
	
	'PAYMENT_DETAILS'=>array('id'=>'test5952', 'pass'=>'44b89'),
	
	'PERCENTAGE_CALCULATION'=>array('individual'=>array('field'=>array(
	                                                               'vehicles_count','photocopy_ic','photocopy_driver_license',                                                      'photocopy_latest_bill','photocopy_vehiclegrants'),
	                                                  'array'=>array('operating_area','payment_methods','payment_terms','service_categories')
	                                                   ),
									'company'=>array('field'=>array(
	                                                               'vat_registered','employees_count','drivers_count','vehicles_count','established_year','photocopy_ic','photocopy_ssm','photocopy_vehiclegrants'),
	                                                  'array'=>array('operating_area','payment_methods','payment_terms','service_categories')
	                                                   )
													   ),
	
	
);
