<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Bootstrap -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" id="main-theme-script">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css" rel="stylesheet" id="theme-specific-script">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">

	<!-- Theme -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/theme.css" rel="stylesheet">
	
	 <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	

		<<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>

		

		
	<script type="text/javascript">
	var SITE_BASE_URL = '<?php echo Yii::app()->request->baseUrl; ?>/';
	$(function(){
		$('.nav-collapse  ul.nav li').hover(function(){
		 $(this).find('ul').show();
		},function(){
			$(this).find('ul').hide();
		});
	});
	</script>
	<style type="text/css">
.nav-collapse  ul.nav li ul li{   list-style-type: none; padding:10px 7px; }
.nav-collapse  ul.nav li ul{ position:absolute; background-color:#CB202D; padding:0px !important; min-width:100px;  display:none; }
.nav-collapse  ul.nav li ul a {
    color: #FFFFFF !important;
	text-decoration:none
}
.nav-collapse  ul.nav li ul li:hover{ background-color:#ccc; }
	</style>
</head>

<body>
<!-- Top navigation bar -->
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="brand"><?php echo CHtml::encode(Yii::app()->name); ?></a>
      <div class="nav-collapse">
			<?php 
			
			 if(Yii::app()->session['login']=='login')
			 {
			$this->widget('zii.widgets.CMenu',array(
			  'activeCssClass'=>'active',
             'activateParents'=>true,
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				
				/*array('label'=>'Recent Temples', 'url'=>array('/RecentTemples/index')),*/
				array('label'=>'Temples', 'url'=>array('/temples/admin'),
				         'items'=>array(
						                    array('label'=>'Featured Listing', 'url'=>array('/featured/admin')),
											array('label'=>'Categories', 'url'=>array('/categories/admin')),
											array('label'=>'Temples', 'url'=>array('/temples/admin')),
										  ),
				),
				array('label'=>'Store', 'url'=>array('/storeproducts/admin'),
				        'items'=>array(
											array('label'=>'Categories', 'url'=>array('/storecategories/admin')),
											array('label'=>'Products', 'url'=>array('/storeproducts/admin')),
											array('label'=>'Order Management', 'url'=>array('/order/admin')),
										  ),
				),
				array('label'=>'E-Pooja', 'url'=>array('/pooja/admin'),
				          'items'=>array(
											array('label'=>'Categories', 'url'=>array('/poojacategories/admin')),
											array('label'=>'E-Pooja', 'url'=>array('/pooja/admin')),
										  ),
				),
				
				array('label'=>'News & Events', 'url'=>array('/news/admin'),
				          'items'=>array(
						array('label'=>'Events', 'url'=>array('/events/admin')),
						array('label'=>'News', 'url'=>array('/news/admin')),
					  ),
				),
				
				array('label'=>'Categories', 'url'=>array('/iyercategories/index'),
				  'items'=>array(
						array('label'=>'Iyer Categories', 'url'=>array('/iyercategories/index')),
						array('label'=>'Guide Categories', 'url'=>array('/guidecategories/admin')),
					  ),
					  ),
				array(
					  'label'=>'Users',
					  'url'=>array('/user/manage/role/2'),
					  'linkOptions'=>array('id'=>'menuUsers'),
					  'itemOptions'=>array('id'=>'itemUsers'),
					  'items'=>array(
						array('label'=>'Normal Users', 'url'=>array('/user/manage/role/2')),
						array('label'=>'Guides', 'url'=>array('/user/manage/role/3')),
						array('label'=>'Iyers', 'url'=>array('/user/manage/role/4')),
					  ),
					),
					
					
					array('label'=>'Country', 'url'=>array('/country/admin'),
				         'items'=>array(
						                    array('label'=>'Country', 'url'=>array('/country/admin')),
											array('label'=>'States', 'url'=>array('/states/admin')),
											array('label'=>'Cities', 'url'=>array('/cities/admin')),
										  ),
				),
				
				
				
				
			      array('label'=>'CMS', 'url'=>array('/page/admin')),
			      array('label'=>'Booking Details', 'url'=>array('/BookedTable/admin')),
				  array('label'=>'Currency', 'url'=>array('/currency/admin')),
				
			
				array('label'=>'Services', 'url'=>array('/services/admin')),
				array('label'=>'Languages', 'url'=>array('/languages/admin')),
                array(
					  'label'=>'Notification',
					  'url'=>array('/queries/admin/type/Temple'),
					  'linkOptions'=>array('id'=>'menuUsers'),
					  'itemOptions'=>array('id'=>'itemUsers'),
					  'items'=>array(
					
						array('label'=>'Temple', 'url'=>array('/queries/admin/type/Temple')),
						array('label'=>'Iyer', 'url'=>array('/queries/admin/type/Iyer')),
                                                array('label'=>'Guide', 'url'=>array('/queries/admin/type/Guide')),
					  ),
					),
				array('label'=>'NewsLetter', 'url'=>array('/Newsletter_Subscribers/admin')),
				
				array('label'=>'Blogs', 'url'=>array('/blogs/admin'),
				         'items'=>array(
						                    array('label'=>'Blog Category', 'url'=>array('/blogcategory/admin')),
											array('label'=>'Blog', 'url'=>array('/blogs/admin')),
array('label'=>'Social Networks', 'url'=>array('/social/admin')),
										  ),
				),
				
				
				
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),'htmlOptions'=>array('class'=>'nav')
		)); }else{
		
			$this->widget('zii.widgets.CMenu',array(
			  'activeCssClass'=>'active',
             'activateParents'=>true,
			'items'=>array(
								
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),'htmlOptions'=>array('class'=>'nav')
		)); 
		
		
		} ?></div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<!-- Main Content Area | Side Nav | Content -->    
<div class="container-fluid" id="page" style="margin-top:42px;">
    <div class="row-fluid">
        <div><?php echo $content; ?></div>
    </div>	  
	
	<footer>
	   <p>&copy; <?php echo CHtml::encode(Yii::app()->name); ?> <?php echo date('Y'); ?></p>
	</footer>
</div>


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>

</body>
</html>
<style>
.navbar .nav > li > a {
    color: #ffffff !important;
    float: none;
    padding: 13px 10px !important;
    text-decoration: none;
    text-shadow: 0 1px 0 #ce4213;
}


</style>