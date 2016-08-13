<!doctype html>
<!--[if IE 8]><html class="no-js oldie ie8 ie" lang="en-US"><![endif]-->
<!--[if IE 9]><html class="no-js oldie ie9 ie" lang="en-US">
<style>
 #your-email
 {
 padding:10px 10px 20px !important;
 width:185px;
 }
 #fpi_title
 {
  margin-left:20px !important;
 }
 </style>
 
<![endif]-->

<head>
<title><?php echo $this->pageTitle; ?></title>
<meta charset="UTF-8" />
<script type='text/javascript'>var ua = navigator.userAgent; var meta = document.createElement('meta');if((ua.toLowerCase().indexOf('android') > -1 && ua.toLowerCase().indexOf('mobile')) || ((ua.match(/iPhone/i)) || (ua.match(/iPad/i)))){ meta.name = 'viewport';	meta.content = 'target-densitydpi=device-dpi, width=device-width'; }var m = document.getElementsByTagName('meta')[0]; m.parentNode.insertBefore(meta,m);</script>
<meta name="Author" content="Temples Unlimited" />

<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<meta http-equiv="X-UA-Compatible" content="IE=9"/>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="xmlrpc.php" />
<meta name='robots' content='noindex,follow' />
<link rel="alternate" type="application/rss+xml" title="Temples Unlimited &raquo; Feed" href="feed/" />
<link rel="alternate" type="application/rss+xml" title="Temples Unlimited &raquo; Comments Feed" href="comments/feed/" />
<link rel='stylesheet' id='contact-form-7-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/plugins/contact-form-7/includes/css/styles.css' type='text/css' media='all' />
<link rel='stylesheet' id='rs-settings-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/plugins/revslider/rs-plugin/css/settings.css' type='text/css' media='all' />
<link rel='stylesheet' id='rs-captions-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/plugins/revslider/rs-plugin/css/captions.css' type='text/css' media='all' />

<link rel='stylesheet' id='ait-jquery-prettyPhoto-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/prettyPhoto.css' type='text/css' media='all' />
<link rel='stylesheet' id='ait-jquery-fancybox-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/fancybox/jquery.fancybox-1.3.4.css' type='text/css' media='all' />

<link rel='stylesheet' id='ait-jquery-hover-zoom-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/hoverZoom.css' type='text/css' media='all' />
<link rel='stylesheet' id='ait-jquery-fancycheckbox-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/jquery.fancycheckbox.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='jquery-ui-css-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/css/jquery-ui-1.10.1.custom.min.css' type='text/css' media='all' />

<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/comment-reply.min.js'></script>

<?php  if((Yii::app()->controller->action->id !='login') && (Yii::app()->controller->action->id !='epooja') && (Yii::app()->controller->action->id !='iyernew') && (Yii::app()->controller->action->id !='iyer')  && (Yii::app()->controller->action->id !='products') && (Yii::app()->controller->action->id !='forgot') && (Yii::app()->controller->action->id !='password') && (Yii::app()->controller->action->id !='templecreate') && (Yii::app()->controller->action->id !='create') && (Yii::app()->controller->action->id !='update')  && (Yii::app()->controller->action->id !='guide') && (Yii::app()->controller->action->id !='blog') && (Yii::app()->controller->action->id !='contact')  && (Yii::app()->controller->action->id !='placeorderlast') ){ ?>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js'></script>
<?php } ?>


<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/jquery-migrate.min.js'></script>
<?php if(Yii::app()->controller->action->id =='index'){ ?>

<?php } ?>



<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.fancycheckbox.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.simpleplaceholder.js'></script>
<?php if(Yii::app()->controller->id !='profile'){ ?>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false&#038;language=en&#038;ver=3.8.3'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/gmap3.infobox.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/gmap3.min.js'></script>
<?php } ?>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.infieldlabel.js'></script>




<?php if(Yii::app()->controller->action->id !='index')  {  ?>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.prettyPhoto.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.fancybox-1.3.4.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.easing-1.3.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.nicescroll.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.quicksand.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/hover.zoom.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.finishedTyping.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/jquery.jcarousel.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/spin.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/libs/modernizr.touch.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/gridgallery.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/js/rating.js'></script>
<?php } ?>


<link id="ait-style" rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/style_red.css" />
<link id="ait-style" rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/new_style_red.css" />
<link id="ait-style" rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/slider_red.css" />

<link rel='stylesheet' id='jquery-ui-css-css'  href='<?php echo Yii::app()->request->baseUrl; ?>/css/popup_index.css' type='text/css' media='all' />

<?php if(Yii::app()->controller->id =='detail'){ ?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/pager.css">
<?php } ?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common.css" rel="stylesheet" type="text/css">
<script>
'article aside footer header nav section time'.replace(/\w+/g,function(n){ document.createElement(n) })
</script>

<!---------start date picker js,css--------->
<?php if(Yii::app()->controller->id !='detail' && Yii::app()->controller->action->id !='photos' && Yii::app()->controller->action->id !='photos'){ ?>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<?php } ?>
<script>var SITE_BASE_URL = '<?php echo Yii::app()->request->baseUrl; ?>/';</script>
<?php
if(Yii::app()->controller->action->id =='storeold')
{ ?>
<meta content="<?php echo $this->title ?>" property="og:title">
<meta content="<?php echo Yii::app()->getBaseUrl(true).'/uploads/store/details_page/'.$this->pageimage;?>" property="og:image">
<meta content="<?php  echo curPageURL(); ?>" property="og:url">
<meta content="<?php //echo $this->desc; ?>" property="og:description">
<?php } ?>

<?php if(Yii::app()->controller->action->id =='poojaold')
{ ?>
<meta content="<?php echo $this->title; ?>" property="og:title">
<meta content="<?php echo Yii::app()->getBaseUrl(true).'/uploads/pooja/details_page/'.$this->pageimage;?>" property="og:image">
<meta content="<?php  echo curPageURL(); ?>" property="og:url">
<meta content="<?php //echo $this->desc; ?>" property="og:description">
<?php } ?>
</head>



<body class="home page page-id-7 page-parent page-template page-template-page-dir-home-php ait-businessfinder" data-themeurl="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder">
<div id="page" class="hfeed header-type-map">

<style>
body
{
font-family:"ralewayregular" !important;
}
</style>

<?php
if(Yii::app()->controller->action->id !='news'){
Yii::app()->session['categories']='all';
}

if(Yii::app()->controller->action->id !='events'){
Yii::app()->session['events_value']='all';
}

$cmspages = Page::model()->findAll();
?>

<div class="topbar"></div>

<div class="wrapper header-holder" style="">
    <div id="logo" class="left"> <a class="trademark" href="<?php echo Yii::app()->request->baseUrl; ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/temples-red1.png" alt="Temples Unlimited" style="margin-top:-50px; margin-bottom:-30px; " /> </a> </div>
    <div class="menu-container right clearfix">

	   <div class="menu-content defaultContentWidth clearfix right">
        <nav id="access" role="navigation"> <span class="menubut bigbut">Main Menu</span>
          <nav class="mainmenu">
            <ul id="menu-main-menu" class="menu" >
              <li id="menu-item-8211" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(Yii::app()->controller->id == 'default' &&  Yii::app()->controller->action->id == 'index'){ ?>current-menu-item page_item page-item-7 current_page_item menu-item-has-children<?php } ?> menu-item-8211"><a href="<?php echo CController::CreateUrl('/front'); ?>">Home</a></li>
              <li id="menu-item-8212" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(Yii::app()->controller->action->id == 'epooja' ||  Yii::app()->controller->action->id == 'pooja'|| Yii::app()->controller->action->id == 'poojaold'){ ?>current-menu-item page_item page-item-7 current_page_item menu-item-has-children<?php } ?> menu-item-8212"><a href="<?php echo CController::CreateUrl('/epooja'); ?>">E-Pooja</a></li>
			  
              <li id="menu-item-8212" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(Yii::app()->controller->action->id == 'products' ||  Yii::app()->controller->action->id == 'product' || Yii::app()->controller->action->id == 'storeold'){ ?>current-menu-item page_item page-item-7 current_page_item menu-item-has-children<?php } ?> menu-item-8212"><a href="<?php echo CController::CreateUrl('/products'); ?>">Store</a></li>
			  
			  
			 <li id="menu-item-8212" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(Yii::app()->controller->action->id == 'news' || Yii::app()->controller->action->id == 'events' || Yii::app()->controller->action->id == 'calender'){ ?>current-menu-item page_item page-item-7 current_page_item menu-item-has-children<?php } ?> menu-item-8212"><a href="<?php echo CController::CreateUrl('/news'); ?>">News & Events</a></li>
			 
			 
			 
			 
			 <li id="menu-item-8212" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(Yii::app()->controller->action->id == 'howitworks'){ ?>current-menu-item page_item page-item-7 current_page_item menu-item-has-children<?php } ?> menu-item-8212"><a href="<?php echo CController::CreateUrl('/howitworks'); ?>"><?php echo strtoupper($cmspages[1]->ptitle); ?></a></li>
			 
 
			   <?php if(Yii::app()->user->isGuest){   ?>
			     <li id="menu-item-8212" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(Yii::app()->controller->action->id == 'login'){ ?>current-menu-item page_item page-item-7 current_page_item menu-item-has-children<?php } ?> menu-item-8212"><a href="<?php echo CController::CreateUrl('/login'); ?>">Login</a></li>
				  <?php }else{ ?>
		 
		   <li id="menu-item-8212" class="menu-item menu-item-type-post_type menu-item-object-page <?php if(Yii::app()->controller->action->id == 'user' || Yii::app()->controller->action->id == 'password' ||Yii::app()->controller->action->id == 'reviews'  || Yii::app()->controller->action->id == 'favourites'  || Yii::app()->controller->action->id == 'cart' || Yii::app()->controller->action->id == 'orders' ||  Yii::app()->controller->action->id == 'photos' || Yii::app()->controller->action->id == 'guideplan' || Yii::app()->controller->action->id == 'poojas' || Yii::app()->controller->action->id == 'iyeractivity' || Yii::app()->controller->action->id == 'iyeractivity' ||  Yii::app()->controller->action->id == 'certificates' || Yii::app()->controller->action->id == 'view' || Yii::app()->controller->action->id == 'iyernodification'|| Yii::app()->controller->action->id == 'update'){  ?>current-menu-item page_item page-item-7 current_page_item menu-item-has-children<?php } ?> menu-item-8212"><a href="<?php echo CController::CreateUrl('/user'); ?>">My Account</a></li> 
		   
		 <?php } ?>
		 
		  
		 
            </ul>
			
          </nav>
        </nav>
		

		
		<?php 

		if(isset(Yii::app()->session['cart']))
		{
		$new_string =0;
		
		foreach(Yii::app()->session['cart'] as $key=>$cart)
		if(isset($cart['cart_type']) &&  $cart['cart_type']!='') { $new_string =1; };
		
		$totalamount =  array();
		foreach(Yii::app()->session['cart'] as $key=>$cart)
		{
		if(isset($cart['cart_type']) &&  $cart['cart_type']!='') {  
		
		
		$cart_count =1;
		}
		else
		{
		if ($new_string==1) continue;
		
		$cart_count = isset(Yii::app()->session['cart'])?count(Yii::app()->session['cart']):'0';
		} 
		}
		}
		 ?>
      </div>
    </div>
  </div>
  
  
   <?php if(Yii::app()->user->isGuest){   ?>
	
	
	<div class=" wrapper" style="margin-bottom:20px; margin-top:-20px;">
<a style="background-color: #f4f4f4; color: #000; font-weight:bold; font-size:12px;border-radius:5px;float:right;padding:7px 9px 9px; " class="right" href="<?php echo CController::CreateUrl('/cart'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/addcarts.gif" style="float:left;" /><span id="cart_count">Cart (<?php echo (isset($cart_count))?$cart_count:'0';  ?>)</span></a>
</div>


				  <?php }else if(isset(Yii::app()->user->id))
				  {
				  $user=Profile::model()->findByPk(Yii::app()->user->id);
				  
				  
				  if($user->role=='2') {?>
				  
				<div class=" wrapper" style="margin-bottom:20px; margin-top:-20px;">
<a style="background-color: #f4f4f4; color: #000; font-weight:bold; font-size:12px;border-radius:5px;float:right;padding:7px 9px 9px; " class="right" href="<?php echo CController::CreateUrl('profile/cart'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/addcarts.gif" style="float:left;" /><span id="cart_count">Cart (<?php echo (isset($cart_count))?$cart_count:'0';  ?>)</span></a>
</div>

<?php }  } ?>	  
				  
  
   <?php   $socail = Social::model()->findAll();   ?>
<div id="main" class="mainpage <?php if(Yii::app()->controller->id !='detail' && Yii::app()->controller->id !='review' && Yii::app()->controller->action->id !='blog'){ ?>onecolumn<?php } ?>">
    <?php if(Yii::app()->controller->id =='detail' || Yii::app()->controller->id =='list'  || Yii::app()->controller->id =='review' || Yii::app()->controller->id =='auto'){ ?>
	  <div class="subcats-holder onecolumn" style="padding:20px 0 20px 0;">
   <div class="wrapper">
     
	 <?php if(Yii::app()->controller->action->id =='guide'  || Yii::app()->controller->action->id =='guide'  || Yii::app()->controller->action->id =='blog'  || Yii::app()->controller->action->id =='blogdetails' ){ ?>

	 	 <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/temples'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/temple1.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Temples</h5>
       </div>
       </a> </div>
	   
	 
	 <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/epooja'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/pooja-set.jpg" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">E-Pooja</h5>
       </div>
       </a> </div>
	   
    
     <div class="sc-column sc-column-last one-third-last" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/iyernew'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/iyer1_new.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Iyer</h5>
       </div>
       </a> </div>
   </div>
 </div>
 
 <?php } ?>

 <?php if(Yii::app()->controller->action->id =='addreviews' ){ ?>
	
        <h1 class="section-title" style="margin-top:30px; margin-bottom:30px; text-align:center"> <a title="Temple Guide" href="">Temple Review</a> </h1>
    </div>
 </div>
 <?php } ?>
 
 
 
 <?php if(Yii::app()->controller->action->id =='iyer' || Yii::app()->controller->action->id =='iyer_list' || Yii::app()->controller->action->id =='iyernew'){ ?>
	 
	 
	 <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/temples'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/temple1.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Temples</h5>
       </div>
       </a> </div>
	   
	 
	 <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/epooja'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/pooja-set.jpg" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">E-Pooja</h5>
       </div>
       </a> </div>
	   
    
     <div class="sc-column sc-column-last one-third-last" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/guide'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/guide1.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Guide</h5>
       </div>
       </a> </div>
  </div>
 </div>
 <?php } ?>
 
 
 <?php if(Yii::app()->controller->action->id =='temples'  || Yii::app()->controller->action->id =='temple' ||  Yii::app()->controller->action->id =='templesmap'){ ?>
	 
	 
	 <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/epooja'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/pooja-set.jpg" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">E-Pooja</h5>
       </div>
       </a> </div>
	   
    
     <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/guide'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/guide1.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Guide</h5>
       </div>
       </a> </div>
	   
	        <div class="sc-column sc-column-last one-third-last" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/iyernew'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/iyer1_new.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Iyer</h5>
       </div>
       </a> </div>
   </div>
 </div>
 
 <?php } ?>
 
 
 <?php if(Yii::app()->controller->action->id =='epooja'  || Yii::app()->controller->action->id =='pooja' || Yii::app()->controller->action->id =='products'  || Yii::app()->controller->action->id =='product' ||  Yii::app()->controller->action->id =='newsevents'  ||  Yii::app()->controller->action->id =='newsdetails' ||  Yii::app()->controller->action->id =='news'  ||  Yii::app()->controller->action->id =='events'|| Yii::app()->controller->action->id =='poojaold'  || Yii::app()->controller->action->id =='storeold'  || Yii::app()->controller->action->id =='calender'  || Yii::app()->controller->action->id =='poojalist' || Yii::app()->controller->action->id =='productlist'){ ?>
	 
	 
	 	 <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/temples'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/temple1.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Temples</h5>
       </div>
       </a> </div>
	   
    
     <div class="sc-column one-third" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/guide'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/guide1.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Guide</h5>
       </div>
       </a> </div>
	   
	        <div class="sc-column sc-column-last one-third-last" style="border:1px solid #c1c1c1; margin-left:-2px;"> <a href="<?php echo CController::CreateUrl('/iyernew'); ?>"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/slider/iyer1_new.png" width="100%" style=" margin-top:-10px;">
       <div style="padding:0 10px 0 10px">
         <h5 style="text-align:center; font-size:23px; padding-top:10px; font-weight:600;">Iyer</h5>
       </div>
       </a> </div>
   </div>
 </div>
 
 <?php } ?>
    <?php } ?>
 
				<?php if(Yii::app()->controller->id !='detail' &&  (Yii::app()->controller->action->id !='default' && Yii::app()->controller->action->id !='index')){ ?>
				<div class="wrapper">
				<?php } ?>
				<?php echo $content; ?>
				<?php if(Yii::app()->controller->id !='detail'){ ?>
				</div>
				<?php } ?>

  
  <footer id="colophon" class="page-footer mainpage" role="contentinfo">
			<div class="wrapper">
			<div class="row" style="margin-top:10px;">
			<div class="col-md-5">
			<div class="wpcf7" id="wpcf7-f7713-o1">
			<form novalidate="novalidate" class="wpcf7-form" method="post" action="/businessfinder/wp1/contact/#wpcf7-f7713-o1">
			<p  class="left">
			<span class="wpcf7-form-control-wrap your-email">
			<input type="email"  placeholder="Email" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"name="your-email" id="your-email"  >
			</span> </p>
			<input onClick="return ns();" type="submit" value="Subscribe Newsletter" class="sc-button alignleft light right"  style="background-color: #CB202D; color: #fff; font-style:bold; font-size:13px; margin-left:5px; border-radius:3px;border:1px solid #cb202d;" id="newsleetr_button" />
			</form>
			</div>
			</div>
			<div class="col-md-3">
			<?php if(Yii::app()->controller->action->id !='index' ){ ?>
			<div class="sc-column sc-column-last one-half-last" >
			<div class="social-icons contact-info center" id="footerdocial">
			<a href="<?php echo $socail[0]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/facebook-ff.png"  alt="Facebook"> </a> 
			<a href="<?php echo $socail[1]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/pinterest-ff.png" alt="Pinterest."></a> 
			<a href="<?php echo $socail[2]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/twitter-ff.png" alt="Twitter"></a> 
			<a href="<?php echo $socail[3]->url;  ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wp-content/themes/businessfinder/design/img/social-icons/flickr-ff.png" alt="Flickr"></a> 
			</div>
			</div>
			<?php } ?>
			</div>
			<div style="float:right;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/temples_refnew1.png"></div>
			</div>
			</div>
	
	 <div class="wrapper">
	 <div class="row" ><div class="col-md-12" id="req-email" style=" float:left;color:#FF0000;font-size:12px; margin-top:-1px; font-size:12px;"></div></div>
	 </div>
	 
		<div id="site-generator" class="wrapper">
		<div id="footer-text">
		<span><strong>© Copyright 2014 Temples Unlimited Inc.</strong>All rights reserved.</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Developed by  <a target="_blank" href="http://blaze.ws/"  style="color:#666666;"><strong>BLAZE WEB SERVICES.</strong></a>
		</div>
		<nav class="footer-menu">
		<ul id="menu-footer-menu" class="menu">
		<li id="menu-item-8236" class="menu-item menu-item-type-post_type menu-item-object-page  menu-item-8260"><a href="<?php echo CController::CreateUrl('/blog'); ?>">Blogs</a></li>
		<li id="menu-item-8236" class="menu-item menu-item-type-post_type menu-item-object-page  menu-item-8260"><a href="<?php echo CController::CreateUrl('/term'); ?>"><?php echo $cmspages[3]->ptitle; ?></a></li>
		<li id="menu-item-8260" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8260"><a href="<?php echo CController::CreateUrl('/about'); ?>"><?php echo $cmspages[2]->ptitle; ?></a></li>
		<li id="menu-item-8237" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8237"><a href="<?php echo CController::CreateUrl('/contact'); ?>">Contact Us</a></li>
		</ul>
		</nav>
		</div>
	
  </footer>
  
  
  <script>
	 function ns(){
		$("#req-email").text("");
		$("#req-email").show();
		var x = $("#your-email").val();
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		$("#your-email").css("background-color","#fbd9d9");
		$("#your-email").css("border","2px solid red");
		$("#req-email").text("Please enter a valid Emailid");
		return false;
		}
		else
		{
		$("#req-email").hide();
		}
		
		$.ajax({
		url : '<?php echo CController::CreateUrl('/front/default/nsajax'); ?>',
		type : "post",
		data : "email="+x,
		success:function(data)
		{
		if(data != "Please confirm your email id. A confirmation email has been sent to your inbox.Please check your Spam folder too."){
		$("#req-email").text("");
		$("#req-email").show();
		$("#req-email").text("Emailid already Registered");
		}
		else
		{
		 $("#req-email").text(data);
		 $("#req-email").show();
		}
		$("#your-email").val("");
		$("#your-email").css("background-color","#ffffff");
		$("#your-email").css("border","2px solid #e8e8e8");
		} 
		});
		return false;
		}
	 </script>
	 
<!-- #page -->
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/preview.ait-themes.com\/businessfinder\/wp1\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","sending":"Sending ...","cached":"1"};
/* ]]> */
</script>
<!--<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-content/plugins/contact-form-7/includes/js/scripts.js'></script>-->
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.core.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.widget.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.tabs.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.accordion.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.position.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.menu.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.autocomplete.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.mouse.min.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/wp-includes/js/jquery/ui/jquery.ui.slider.min.js'></script>

<?php if((Yii::app()->controller->action->id !='login')){ ?>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/common.js'></script>
<?php } ?>	   
</body>
</html>


<?php if(Yii::app()->controller->action->id !='temple'){ ?>
<style>

#page .ait-tabs .ui-tabs-nav li.ui-state-default a {
display: block;
font-family: "ralewayextrabold";
font-size: 16px;
padding: 2px 15px;
text-decoration: none;
transition: none 0s ease 0s ;
}
</style>

<?php } ?>


<style>
@media (min-width: 768px) {
.wpcf7 input, .wpcf7 textarea
{
line-height:inherit;
padding:6px 7px;
}


#newsleetr_button {
padding-top:5px;
}
}

@media (max-width: 480px) {
#newsleetr_button {
padding:8px 8px ;
}
#your-email
{
 padding:10px;
}

}

@media (max-width: 767px) {
#newsleetr_button {
padding-top:5px;
height:39px;
}


.ie9 #fpi_title
{
margin-left:-30px !important;
}
}
</style>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/placeholder.js"></script>
<?php  if(Yii::app()->controller->action->id =='user'){ ?>
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrapfront.css" />
<link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-timepicker.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mdp.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-timepicker.js"></script>
<?php } ?>
