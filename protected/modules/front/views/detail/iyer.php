<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootsrap.min.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
<?php
/* @var $this TemplesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'View Iyer - '.$model->first_name.' '.$model->last_name,
);

$this->menu=array(
);

 if($model->primary_image!='')
 {
  $iyer_image =  $model->primary_image; 
 }
 else
 {
   $iyer_image =  $model->user_image;
 }
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/css/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>






<?php  $reviewdetail = Reviews::model()->get_reviews_count('iyer',$model->user_id); 
$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids(explode(',',$model->iyermoredetails->iyer_sec_languages)),'language_id','language_name'));


$criteria1 = new CDbCriteria();
		$condition1 ='';
		$condition1 .= 'user_id ="'.$model->user_id.'" ' ;
		$condition1 .= 'and book_date >= "'.date('Y-m-d').'"' ;
		$condition1 .= 'and iyer_status = "yes"' ;
		$criteria1->condition =  $condition1;
$booked_details = BookedTable::model()->findAll($criteria1);


 $booked_array = array();
				  
				  
				  $datesexist ='';
                      
					  if(count($booked_details)>0)
					  {
					for($i=0;$i<count($booked_details);$i++)
					{
					  $datesexist .= '"'.$booked_details[$i]->book_date.'",'; 
					  array_push($booked_array,$booked_details[$i]->book_date);
					}
					}
					
					
					
			$iyerpoojas = Iyerpoojas::model()->findAll('user_id=:user_id',array(':user_id'=>$model->user_id));
			$secondarylanguages ='';
			$lowest_price1 = array();
			for($i=0;$i<count($iyerpoojas);$i++)
			{
			$iyerpoojas[$i]->mantra_language = explode(',',$iyerpoojas[$i]->mantra_language); 
			$secondarylanguages .= implode(',',CHtml::listData(Languages::model()->getall_byids($iyerpoojas[$i]->mantra_language),'language_id','language_name'));
			$secondarylanguages .=',';
			array_push($lowest_price1,$iyerpoojas[$i]->amount_without_items);
			}
			$iyer_languages = explode(',',$secondarylanguages);
			$iyer_languages2 = array_unique($iyer_languages);
			$iyer_languages3  = array_filter($iyer_languages2);	
			$iyer_languages3 = array_reverse($iyer_languages3);
			
		
		$to_remove = array($model->languagename->language_name);
		$iyer_languages4 = array_diff($iyer_languages3, $to_remove);
		$iyer_languages4 = implode(', ',$iyer_languages4);
		
		

		 $iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$model->user_id));
		
		
		   if(count($lowest_price1)>0)
			$lowest2 = min($lowest_price1); 
			else
			$lowest2 =  $iyermoredetails ->iyer_amount;
			
			
			
			if($iyermoredetails ->iyer_amount>$lowest2)
			$amount3 =  $lowest2;
			else
			$amount3 =   $iyermoredetails ->iyer_amount; 	

?>
<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/iyernew'); ?>">Iyer </a><span style="color:#c1c1c1;">  &nbsp;>>&nbsp; </span><?php  echo $model->gender.'. '.$model->first_name.' '.$model->last_name; ?></h3>
</div>
</div>

<div id="wrapper-row">
      <div id="content" role="main">
		  
        <div id="primary">
		

<?php if(Yii::app()->user->hasFlash('queries')): ?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('queries'); ?>
</div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('booked')): ?>
<div class="flash-success">
<?php echo Yii::app()->user->getFlash('booked'); ?>
</div>
<?php endif; ?>


          <h2 class="section-title"><?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?></h2>
          <div class="item-stars clearfix left" style="margin-right:10px;">  <?php echo Reviews::model()->show_average_stars('iyer',$model->user_id); ?>  </div>
          <div style="margin-top:-5px;"> <strong> <strong><?php  $reviews = Reviews::model()->get_reviews_count('iyer',$model->user_id);  echo $reviews['count'];?></strong> </strong> Customer reviews</div>
          <br>
          <div id='gallery-1' class='gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail'>
            <dl class='gallery-item'>
              <dt class='gallery-icon landscape'> 
			  
			  <?php  
		if($iyer_image!=''){
		$iyer_image1 = explode('/',$iyer_image); 
		
		if(count($iyer_image1)=='3'){?>
<img  src="<?php echo Yii::app()->request->baseUrl.'/uploads/users/resize/'.$iyer_image1[2]; ?>" class="attachment-thumbnail"  alt="<?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?>" />
		<?php
		}else{
		?>
		<img  src="<?php echo Yii::app()->request->baseUrl.'/uploads/iyer/images/resize/'.$iyer_image1[3]; ?>" class="attachment-thumbnail"  alt="<?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?>" />
		<?php
		}?>
   </dt>
			   
			   <?php } else { ?>
			   
			    	<img  src="<?php echo Yii::app()->request->baseUrl.'/image/no_image.jpg'; ?>"   class="attachment-thumbnailnew"  alt="<?php echo  $model->gender.'. '.$model->first_name.' '.$model->last_name; ?>" style="height:275px; width:275px; "   />   </dt>
			   
			   <?php } ?>
              <dd class='wp-caption-text gallery-caption'> </dd>
            </dl>
            <br style='clear: both;' />
          </div>
	  
		  
          <div class="tab-font">
		  
		  
            <div class="ait-tabs" id="ait-tabs-641">
              <ul>
              </ul>
              <br />

              <div class="ait-tab tab-content items-grid-view"  data-ait-tab-title="Details">
				<p style="margin-bottom:0"> <strong>Total Experience:</strong> <?php echo $model->iyermoredetails->iyer_experience; ?>&nbsp;<?php echo $model->iyermoredetails->iyer_experience_type; ?><br>
				
				<?php 
				
				if($model->iyermoredetails->iyer_country!='0' && $model->iyermoredetails->iyer_state!='0' && $model->iyermoredetails->iyer_city!='0') 
				{
				$residenace = $model->iyermoredetails->iyercity->name.', '.$model->iyermoredetails->iyerstate->state_name.', '.$model->iyermoredetails->iyercountry->country;  
				}
				else if($model->iyermoredetails->iyer_country!='0' && $model->iyermoredetails->iyer_state!='0' && $model->iyermoredetails->iyer_city=='0') 
				{
				$residenace = $model->iyermoredetails->iyerstate->state_name.', '.$model->iyermoredetails->iyercountry->country;  
				}
				else  if($model->iyermoredetails->iyer_country!='0' && $model->iyermoredetails->iyer_state=='0' && $model->iyermoredetails->iyer_city=='0')
				{
				  $residenace = $model->iyermoredetails->iyercountry->country;
				}

				
				if(isset($residenace)){ ?>

				<strong>Residence:</strong> <?php  echo $residenace;  ?><br>
				
				<?php } ?>
				
				<?php if($model->gender1!='') {?>	
				<p><strong>Gender:</strong> <?php echo $model->gender1; ?><br>
				<?php } ?>
				<strong>Primary Language:</strong> <?php echo $model->languagename->language_name; ?><br>
				<?php if(isset($iyer_languages4) && $iyer_languages4!=''){ ?>
				<strong>Other Languages :</strong> <?php  echo $iyer_languages4; ?><br>	
				<?php } ?>
				<?php 
				   $availability_dates = explode(',',$model->iyermoredetails->availability_dates);
				  
					$availability = array();
					for($i=0;$i<count($availability_dates);$i++)
					{
					if($availability_dates[$i]>=date('Y-m-d'))
					  array_push($availability,$availability_dates[$i]);
					}
					$dates = '';
					for($i=0;$i<count($availability);$i++)
					{
					if(!in_array($availability[$i],$booked_array))
					  $dates .= "'$availability[$i]'".','; 
					}
					 ?>
              
			  <div class="rule">&nbsp;</div>
			  
			  
			   <?php   $activities = Iyerpoojas::model()->get_all($model->user_id);  
			  
		   if($activities){ ?>
			  
			  <div>
			  <h4>Availability:</h4>

			<div id="date-select" >
			<div id="date-check"></div>
			
			<div id="calender"  style="border-bottom:1px solid #cccccc;border-top:1px solid #cccccc;  " >
			<strong class="check">When do you want to go?</strong>
<input type="submit" value="Pick a Date" class="editfiledlink" id="edit_old" style=" border:2px solid #cb202d;background-color: #cb202d;border-radius: 3px;color: #fff;font-size: 13px;margin: 15px;width: 100px;padding:6px 6px;">
</div>
<div class="wpcf7 editfieldsdiv" id="first_old" style="border-bottom:1px solid #cccccc; height:auto; ">
<hr / >
						
						<div class="editfields">
						
					<div style="font-size:13px;">Choose your date:</div><div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cross.png" style="float:right; cursor:pointer; margin-right:170px; margin-top:-3px;"  onclick="showcalender()"/></div>
					
					<script>
				   function showcalender()
				   {
				   var choosed_date1 = '<?php echo Yii::app()->session['choose_date']; ?>';
				   
				   if(choosed_date1!='')
				   {
				   $('#first_old').hide();
				   }
				   else
				   {
				     $('#first_old').hide();
					 $('#calender').show();
				   }
				   }	
					</script>
					
					
					<div id="datepicker"></div>
						
						
						
						<div style="height:50px; margin-top:30px;" >
						
						
						
						<div style="width:80%; margin-left:25%; ">
					<div style="width:25%; float:left;">
					<div class="foo" style="background-color:#C5E8A5;"></div><div style="margin-top:2px;">Available</div>
					</div>
					
					<div style="width:25%; float:left;">
					<div class="foo" style="background-color:#FDCBCC;"></div><div style="margin-top:2px;">Unavailable</div>
					</div>
					
					<div style="width:25%; float:left;">
					<div class="foo" style="background-color:#f4f4f4;"></div><div style="margin-top:2px;">Past</div>
					</div>
					
					</div>
						
						  
						</div>
						</div>
						<div style="clear:both;">&nbsp;</div>
						</div>
						
						
			
			
			</div>
			
			</div>
			
			
			 <?php } ?>

			  <div>
			 <p style="margin-top:15px;"><b>&nbsp;Activity Options</b></p>
			  
			 
			  <ul class="activitiesplans">
			  <?php	
		
			  if($activities){

			 $ids='';
			 
			 for($i=0; $i<count($activities);$i++)
			 {
			 $ids .= 'stateedit_'.$i.',';
			 $minprice = $activities[$i]->amount_without_items;
			 
			  if($activities[$i]->mantra_language!='') {$activities[$i]->mantra_language = explode(',',$activities[$i]->mantra_language); 
			$secondarylanguages = implode(', ',CHtml::listData(Languages::model()->getall_byids($activities[$i]->mantra_language),'language_id','language_name'));}
			
			if($activities[$i]->discount_dates_from!='')
			{
			$discount_dates_from =explode('-',$activities[$i]->discount_dates_from); 
			
			$start = date('F', mktime(0, 0, 0,$discount_dates_from[1],10)).' '.$discount_dates_from[2].',  '.$discount_dates_from[0];
			
			$discount_dates_to =explode('-',$activities[$i]->discount_dates_to); 
			

                    $discount_dates_to = array_filter($discount_dates_to);

			if(count($discount_dates_to)>0)
			$end = date('F', mktime(0, 0, 0,$discount_dates_to[1],10)).' '.$discount_dates_to[2].',  '.$discount_dates_to[0];

			if(count($discount_dates_to)>0)
			$dates_print =  $start.' - '.$end ;
                        else
                        $dates_print =  $start;

			}
			else
			{
			$dates_print =''; 
			}
			
			if($activities[$i]->discount=='Yes')
			{
			$temp = $minprice *($activities[$i]->discount_percentage / 100);
			
			$cuttent_amount = $minprice - $temp;
			}
			else
			{
			$cuttent_amount =  $minprice; 
			}
			?>
						<li class="option" id="to_5459">
						<div class="sc-column one-half left">
						<div class="title" style="font-weight:bold;"><strong><?php echo $activities[$i]->pooja_name; ?></strong></div>
						<p style="margin-top:15px;">
						<?php ?>
						<?php echo $activities[$i]->description; ?>
						<br>
						<strong>Mantra Language&nbsp;:</strong>&nbsp;<?php echo $secondarylanguages; ?>
						<br>
						<strong>Duration : </strong><?php echo $activities[$i]->duration." ".$activities[$i]->duration_time_type; ?>
						</p>
						
						</div>
						<div>
						<p style="margin-left:73%;">From <strong><?php echo  $model->iyermoredetails->iyer_amount_option.' '.$cuttent_amount; ?></strong></p>
						<br>
						
						
						<?php if($activities[$i]->discount=='Yes') {?>
						
						<p style="margin-left:80%;"><strike><?php echo  $model->iyermoredetails->iyer_amount_option.' '.$minprice; ?></strike><strong></strong></p>
						<p style="margin-left:80%; color:#FF0000; font-weight: bold;">Save<strong> <?php echo  $activities[$i]->discount_percentage.'%'; ?></strong></p>
						<p style="margin-left:60%;width:50%;color:#FF0000; text-align: center; font-size:12px;"><br /><?php   echo $dates_print;   ?></p>

						<?php }?>
						
						<div class="right" style="color:#FF0000;" id="check_button"> 
						<input type="submit" class="editfiledlink"   value="Check Availability" id="<?php echo $i; ?>"  style=" border:2px solid #cb202d;background-color: #cb202d;border-radius: 3px;color: #fff;font-size: 13px;margin: 15px;width: 150px;padding:6px 6px;" onclick="$('#first_old').show();$('#calender').hide();"> <br></div>
						
						<div class="right test" style="color:#FF0000; display:none;" id="editfiledlink_<?php echo $i; ?>"> 
						
						<?php  if(Yii::app()->session['with_givendate']=='Not available') { 
					
						
						?>

						<input type="submit"  value="<?php  echo  Yii::app()->session['with_givendate']; ?>"  style=" border:2px solid #cb202d;background-color: #cb202d;border-radius: 3px;color: #fff;font-size: 13px;margin: 15px;width: 150px;padding:6px 6px;cursor: none;">
						  
						<?php }else{  ?>
						
						<input type="submit"   value="Choose option" onclick="selectpooja('<?php echo $activities[$i]->id; ?>','<?php echo $i; ?>');" id="choose_option_<?php echo $i; ?>"  style=" border:2px solid #67a031;background-color: #67a031;border-radius: 3px;color: #fff;font-size: 13px;margin: 15px;width: 150px;padding:6px 6px;">
						
						<?php } ?>
						<br>
						
						</div>
						
						</div>

						
								<div class="clear">&nbsp;</div>
								
								
								<div id="select_option_values_<?php echo $i; ?>"></div>
								

						<div class="clear">&nbsp;</div>
			
						</li>
						
								
                  <div style="clear:both;"> </div>
				  
				  
						<?php
						}
						}
						else{
						?>
						<hr />
						<div  style=" text-align:center;"><b>No activity found</b></div>
						<?php
						}
						?> 
						</ul>
						</div>


<script>

var choosed_date = '<?php echo Yii::app()->session['choose_date']; ?>';

var dates1 = [<?php echo $model->user_id; ?>];

if(choosed_date!='')
{
	$.ajax({
				url :'<?php echo $this->createUrl('detail/availability_status'); ?>',
				type : "post",
				data : "date="+choosed_date+"&dates1="+dates1+"&type=iyer",
				success:function(data)
				{
				$('#date-check').html(data);
				$('#calender,#check_button').hide();
				$('.test').show();
				} 
		});
}

function selectpooja(id,i)
{
$.ajax({
				url :'<?php echo $this->createUrl('detail/poojadetails'); ?>',
				type : "post",
				data : "pooja_id="+id+"&ivalues="+i+"&type=iyer",
				success:function(data)
				{
				$('#select_option_values_'+i).html(data);
				$('#select_option_values_'+i).css({"display":"block"}); 
				$('#calender,.editfieldsdiv,#check_button').css({"display":"none"}); 
				$('#editfiledlink_'+i).css({"display":"none"}); 
				} 
		});
}



jQuery('.editfiledlink').click(function(){
var contentPanelId = jQuery(this).attr("id");
$(".editfieldsdiv").css("display","none"); 
$('#first_old').show();
$('#calender').hide();
});

var dates = [<?php echo $dates; ?>];
var dates1 = [<?php echo $model->user_id; ?>];

var dateold = '<?php echo date('Y-m-d'); ?>';

jQuery(function(){
jQuery('#datepicker').datepicker({
changeMonth : true,
changeYear : true,
minDate: 0,
dateFormat: 'yy-mm-dd',	
onSelect: function(date) 
{

		$.ajax({
				url :'<?php echo $this->createUrl('detail/availability_status'); ?>',
				type : "post",
				data : "date="+date+"&dates1="+dates1+"&type=iyer",
				success:function(data)
				{
				$('#date-check').html(data);
				$('#calender,.editfieldsdiv,#check_button').hide();
				$('.test').show();
				window.location.reload();
				} 
		});
				

},
beforeShowDay : function(date){
var y = date.getFullYear().toString(); 
var m = (date.getMonth() + 1).toString(); 
var d = date.getDate().toString(); 
if(m.length == 1){ m = '0' + m; } 
if(d.length == 1){ d = '0' + d; }
var currDate = y+'-'+m+'-'+d;

if(dateold<=currDate)
{
if(dates.indexOf(currDate) >= 0)
{
return [true, "ui-highlight"];		
}
else
{
return [true,"ui-highlight_red"];
}
}
else
{
return [true,"ui-highlight_brown"];
}	

},
});
})
</script>

<style>
.ui-highlight_brown
{
background-color:#ccc;
}
</style>

			  <div class="rule">&nbsp;</div>
			  <h5>Overview</h5>
			  <?php echo   $model->iyermoredetails->iyer_overview; ?>
                           <br /><br />
			  <?php  if($model->iyermoredetails->iyer_description!='') {?>
			    <h5>Description</h5>
			  <?php echo   $model->iyermoredetails->iyer_description; ?>
			  <?php } ?>
              </div>
			  
			  
              
              <div class="ait-tab tab-content" data-ait-tab-title="Reviews">
				  
     
                   <div class="reviewlistdiv">

                </div>
           
              </div>
        
              <div class="ait-tab tab-content" data-ait-tab-title="Photos">
                  
                <div class="gallery galleryid-438 gallery-columns-4 gallery-size-thumbnail photolistdiv" id="gallery-1">

		</div>

              </div>
            </div><!---------primary------------>
			
			
			
			<script type="text/javascript">
			function callfunction()
			{
			$('#ui-id-2').click();
			//$('#ait-tabs-641 ul li').removeClass('ui-tabs-active ui-state-active');
			//$('#ait-tabs-641 ul li:nth-child(2)').addClass('ui-tabs-active ui-state-active');
			//$('#ait-tabs-641 ul li:nth-child(4) a').tab('show');
			//$('.ait-tab.tab-content').css('display','none');
			//$('#tab-641-2').css('display','block');
			 return false;
			}
			</script>
               
            
            <script type="text/javascript">
		(function($){

			$(function(){

				var $tabs = $("#ait-tabs-641" ),
					$tabsList = $tabs.find("> ul"),
					$tabDivs = $tabs.find(".ait-tab.tab-content"),
					tabsCount = $tabDivs.length;

				$tabs.find("> p, > br").remove();

				var tabId = 0;
				$tabDivs.each(function(){
					tabId++;
					var tabName = "tab-641-"+tabId;
					var sharp = "#";
					$(this).attr("id",tabName);
					var tabTitle = $(this).data("ait-tab-title");
					$('<li><a class="tab-link" href="'+sharp+tabName+'">'+tabTitle+'</a></li>').appendTo($tabsList);
				});

				$tabs.tabs();

				if(typeof Cufon !== "undefined")
					Cufon.refresh();
			});

		})(jQuery);
	</script>
          </div>
        </div>


        <!-- /#primary -->
        
        
        <div id="secondary" class="widget-area" role="complementary">
		
				<?php  if($model->user_image!='')
				{
				   
				  $iyer_image2 = $model->user_image; 
				?>
				
				<div align="center" style=" "> <?php  echo helpers::view_thumb150($iyer_image2); ?></div>
				<?php } else { ?>
				
				<div align="center" style=" "><img src="<?php echo Yii::app()->request->baseUrl.'/image/no_image.jpg'; ?>" class="attachment-thumbnail"  height="150" width="150" /></div>
				
				<?php } ?>
<?php $Usermodel = User::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); ?>	
      
     <div align="center" style="border-radius:5px; background:#FBFBFB; margin-bottom:15px;"> 
	 
	  <?php  if( (Yii::app()->user->isGuest) || (isset($Usermodel) && ($Usermodel['role']=='2'))){ ?>
	 <a style="background-color:#CB202D; color: #fff; font-size:18px; margin:15px; border-radius:3px; width:180px; cursor:pointer"  onclick="show_temp_tabs();"  class=" sc-button light sc-modal-link sc-modal-link-sc-modal-window-modal1"><strong>Book Now</strong></a><?php } ?>  <br>
                  <h5>From <strong><?php echo $model->iyermoredetails->iyer_amount_option."  ".$amount3;  //sc-modal-link sc-modal-link-sc-modal-window-modal1 ?></strong></h5>
            

<div style="display: none;"><div id="sc-modal-window-modal1" style="position:relative; width:600px; height:550px;"><div class="sc-modal-content entry-content content-style">
<h3 style="text-align: center;">Iyer Booking Details</h3>

<script>
function show_temp_tabs()
{
  var choosed_date = '<?php echo Yii::app()->session['choose_date']; ?>';
  
  var with_givendate = '<?php echo Yii::app()->session['with_givendate']; ?>';
  
  if(choosed_date=='')
  {
    $('#calender').hide();
	$('#first_old').show();
	$('html, body').animate({scrollTop:$('#first_old').position().top}, 'slow');  
  }
  else if(with_givendate!='Not available')
  {
    selectpooja('<?php echo (isset($activities[0]->id))?$activities[0]->id:''; ?>','<?php echo '0'; ?>');
	$('html, body').animate({scrollTop:$('#to_5459').position().top}, 'slow'); 
  }
   else 
  {
   $('html, body').animate({scrollTop:$('#tab-641-1').position().top}, 'slow');  
  }
}

</script>

<div class="tab-font">
            <div id="ait-tabs-641" class="">
              
              
        <h3 class="section-title">Booking Details</h3><br>
				<div style="width:70%; font-size:14px;" class="sc-column one-half">
					<div class="left">Amount<br><br>Working Hours<br><br>Choose your Option</div>
				<div class="right"><?php echo  helpers::to_currency($model->iyermoredetails->iyer_amount); ?>/-<br><br><?php //echo  $model->iyermoredetails->iyer_wh1.' - '.$model->iyermoredetails->iyer_wh2; ?><br><br>
				
                 <label class="checkbox"> <input type="radio" checked="checked" value="with_pooja" name="test" id="test">&nbsp;&nbsp;With Pooja Items (<?php //echo  helpers::to_currency($model->iyermoredetails->iyer_amount_with_items); ?>)</label><br><br>
                  <label class="checkbox"> <input type="radio" value="without_pooja" name="test" id="test">&nbsp;&nbsp;Without Pooja Items (<?php //echo  helpers::to_currency($model->iyermoredetails->iyer_amount); ?>)</label><br><br>
                  </div></div>
				
				 
                    
                    
               <a style="background-color:#CB202D; color: #fff; font-size:18px; margin:15px; border-radius:3px; width:180px;" href="javascript:void(0)"  class=" sc-button light sc-modal-link sc-modal-link-sc-modal-window-modal1 right"><strong>Book Now1</strong></a><br>

                
               </div></div>

</div></div></div>

          </div>
   
  	
     
          <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;">
            <h5><strong>We Promise</strong></h5>
            <ul class="style1">
              <li>Speedy booking and reserved spots</li>
              <li>No-hassle Best Price Guarantee</li>
            </ul>
            <div class="rule"></div>
			<div class="right" style="margin-top:-25px;" ><input type="button" value="Ask Queries &raquo;" name="submit"  data-toggle="modal" data-target="#largeModal" ></div>
          </div>
		  
          
           
  <div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;" id="column">
            <h5><strong><?php echo $reviewdetail['count']; ?> Customer Reviews</strong></h5>
            <div class="rule"></div>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">5 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['5stars']; ?>&nbsp;Customer(s)</span></div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">4 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['4stars']; ?>&nbsp;Customer(s)</span></div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">3 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['3stars']; ?>&nbsp;Customer(s)</span>
             </div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">2 Stars</span> <span class="star active"></span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['2stars']; ?>&nbsp;Customer(s)</span>
              </div><br>
            <div class="item-stars clearfix"><span style="float:left; margin-top:-5px; margin-right:10px;">1 Star &nbsp;</span> <span class="star active"></span> <span class="star"></span> <span class="star"></span> <span class="star"></span> <span class="star last"></span>&nbsp;<span style="margin-top:-5px; float:right"><?php echo $reviewdetail['1stars']; ?>&nbsp;Customer(s)</span>
              </div><br>
			  
			  	<?php $reviewscount = Reviews::model()->get_review_all('iyer',$model->user_id); 
				if(isset($reviewscount) && $reviewscount!='')
				{
				?>
				<div class="right" style="margin-top:-15px;"><a href="javascript:void(0);" onclick="callfunction();">See all Reviews &raquo;</a></div>	  
				<?php
				}
				?>
          </div>
		  
		
          
          
		 <?php 
				$criteria = new CDbCriteria(); 
				
				$criteria->select = "t.*,ug.iyer_phone,ug.iyer_city,ug.iyer_state,ug.iyer_country,ug.iyer_description,ug.iyer_sec_languages,rv.*";
				
				$criteria->join = " JOIN iyer ug ON ug.user_id=t.user_id LEFT JOIN reviews rv ON rv.review_itemid=ug.user_id  LEFT JOIN iyerpoojas as ip ON ip.user_id=ug.user_id";
				
				$condition  = ' t.role = 4 AND t.registration_completed=1 and t.email_validated=1 and ug.iyer_overview IS NOT NULL and ug.iyer_wh<>"0.0" and ug.iyer_experience<>"0.0" and 	ug.iyer_experience_type IS NOT NULL and ug.iyer_amount_option IS NOT NULL  and  iyer_amount<>"0.00" and t.status = 1 and t.user_id<>'.$model->user_id.' ';

				
				$criteria->limit ='2';
				
				$criteria->order = 'user_id asc';
				
				$criteria->group = 't.user_id';	

				
				$criteria->condition =  $condition;
				
				$relatedproducts = User::model()->findAll($criteria);
				
				

					
		if(count($relatedproducts)){ ?>
		 
		<div style="border:2px solid #C1C1C1; border-radius:5px; margin-bottom:15px; padding:10px;" id="column">
            <h5><strong>You might also like..</strong></h5>
			
		<?php	
					  foreach($relatedproducts as $relatedproduct){
					  
					   $userimage  = $relatedproduct->user_image;

					    $relatedproduct->iyermoredetails = Iyer::model()->find('user_id=:user_id',array(':user_id'=>$relatedproduct->user_id));
			?>
			
            <p><strong><a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($relatedproduct->user_id))); ?>" style="color:#000000;"><?php echo  $relatedproduct->gender.'. '.$relatedproduct->first_name.' '.$relatedproduct->last_name; ?></a></strong></p>
			<div>
			<a href="<?php echo CHtml::normalizeUrl(array("detail/iyer/id/".helpers::simple_encrypt($relatedproduct->user_id))); ?>">
			
			<?php
						if($userimage!='')
						{
						?>
						<?php echo helpers::view_thumb($userimage,array("class"=>"left","style"=>'max-width:90px'));  ?>

						<?php
						}
						else
						{
						echo helpers::view_thumb150($userimage,array("class"=>"left","style"=>'max-width:90px'));
						} 
					   
				?>	   
			<?php //echo  ?>
			</a>
			<div class="right"><div class="item-stars clearfix"> <?php echo Reviews::model()->show_average_stars('iyer',$relatedproduct->user_id); ?></span>
			</div><p style="padding-top:20px;">From <strong><?php echo  helpers::to_currency($relatedproduct->iyermoredetails->iyer_amount); ?></strong></p></div>
			
			</div>
			<div class="rule"></div>
			
			<?php } ?>
		
			<div class="right-align"><a href="<?php echo CHtml::normalizeUrl(array("auto/iyernew")); ?>">see all &raquo;</a></div>

          </div>
			  <?php } ?>
		     
        </div>
     
    <!-- <div class="rule"></div>-->
	<div id="primary" style="width:100%;">


	<div class="closeable">
		

<div id="comments">

<?php
   
			 $reviews = new Reviews;
			 $reviews->review_itemtype = 'iyer';
			 $reviews->review_itemid = $model->user_id;
			 $this->renderPartial('reviews', array('reviews'=>$reviews)); 
			
			  
	
?>	
	 
	
			
</div>


</div> 			


</div> 		

     
    
     <div> 

   </div>  
							
							
    </div>
    
  </div>


  
 <script type="text/javascript">
jQuery(function(){
jQuery('.reviewlistdiv').load('<?php echo CController::CreateUrl('//front/review/reviewlist/type/iyer/id/'.$model->user_id); ?>');
jQuery('.photolistdiv').load('<?php echo CController::CreateUrl('//front/detail/photolist/type/iyer/id/'.$model->user_id); ?>');
});
<?php if($model->user_id == Yii::app()->user->id){ ?>

 $('.closeable').hide();
<?php } ?>


</script>

<?php


$user = User::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));


if(isset($user->first_name))
{
$name_user = $user->first_name.' '.$user->last_name;
$function22222 ='readonly="readonly"';
}
else
{
 $name_user ='';
$function22222='';
}




if(isset($user->email))
{
$email_user =   $user->email;
}
else
{
$email_user =  '';
}

$user_basic = User::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

if($user_basic->role=='2')
{
  $userdetails = Userdetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); 
  $phone_no =   $userdetails->phone;
}
else if($user_basic->role=='3')
{
  $userdetails = Guide::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); 
  $phone_no =   $userdetails->guide_phone;  
}
else if($user_basic->role=='4')
{
  $userdetails = Iyer::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); 
  $phone_no =   $userdetails->iyer_phone;     
}
 else 
{
  $phone_no = '';    
}

?>




<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<input type="button" class="close"  data-dismiss="modal" aria-hidden="true"  value="&times" style="color:#000000; font-size: 42px;"/>
<h4 class="modal-title" id="myModalLabel">Ask a Queries about this Iyer</h4>
</div>
<div class="modal-body">
<div class="form" style="width:85%; margin-left:5%;">
<form method="post" action="<?php echo CHtml::normalizeUrl(array("detail/queries")); ?>" id="events-form" class="wpcf7-form" onsubmit="return tesr_tectsd();">
<input type="hidden" name="id" value="<?php echo $model->user_id; ?>" id="id" />
<input type="hidden" name="type" value="iyer" id="type" />

<input type="hidden" name="iyer_name" value="<?php echo $model->gender.'.'.$model->first_name.' '.$model->last_name; ?>" id="iyer_name" />
<p>
</p>
<div class="row">
<label class="required" for="Contact_name">Name <span class="required" style="color:">*</span></label>
<input type="text" maxlength="250" id="Contact_name" name="Contact_name" placeholder="Enter Name" value="<?php echo $name_user; ?>" <?php echo $function22222; ?>  class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input_test">
</div>
<p></p>
<p>
</p><div class="row">
<label class="required" for="Contact_email">Email <span class="required">*</span></label>
<input type="text" maxlength="250" id="Contact_email" name="Contact_email" placeholder="Enter Email"  value="<?php echo $email_user; ?>"  class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input_test"  <?php echo $function22222; ?>>
</div>
<p></p>
<p>
</p><div class="row">
<label class="required" for="Contact_subject">Phone Number </label>		
<input type="text" maxlength="250" id="Contact_phone" name="Contact_phone" value="<?php echo $phone_no; ?>" placeholder="Enter Phone No" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input_test"> </div>
<p></p>
<p>
</p>
<div class="row">
<label class="required" for="Contact_message">Message <span class="required">*</span></label>		
<textarea id="Contact_message" name="Contact_message" rows="5" cols="20" placeholder="Enter Question" class="text_area" style=" min-width:90%; max-width:90%;margin-left:-0px;" ></textarea>
</div>

<p></p>
<div class="row buttons">
<input type="submit" value="Send Message" name="submit" class="submit_test"  >
</div>
</form>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>

<script type="text/javascript">
jQuery('#events-form').validate({
rules : {
Contact_name :{required:true},
Contact_email : {required: true, email:true},
Contact_phone : {number: true},
Contact_message : {required: true},
},
messages : {
Contact_name : 'Enter Username',
Contact_email : 'Enter valid email',
Contact_phone : 'Enter valid Phone number',
Contact_message : 'Enter message',
}
});
</script>


<style type="text/css">
.error
{
color:#FF0000;
font-weight: normal;
}
.pp_content{ display:table; }
a.pp_close{ position:relative; float:right; }

.pager{ float:right; }
.activitiesplans li {
    
    border-bottom: 1px solid #CCCCCC;
    border-image: none;
    border-left: 0 none;
    border-top: 1px solid #CCCCCC;
    padding: 10px;
	margin-bottom: 20px;
}
.activitiesplans li .leftside{ float:left;  max-width: 70%; }
.activitiesplans li .rightside{ float:right; }
.activitiesplans p{ margin-bottom:0px; }
.activitiesplans li .leftside .title{ font-weight:bold; }

#content {
    margin-left: auto;
    margin-right: auto;
    padding-top: 20px !important;
    width: 1000px;
}

.ui-widget{
    font-family:"ralewayregular" !important;
}
.input_test
{
background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:300px;
}
.submit_test
{
 background: none repeat scroll 0 0 #333333;
    border: medium none;
    color: #ffffff;
    cursor: pointer;
    display: inline;
    float: right;
    font-family: arial;
    font-size: 12px;
    font-weight: bold;
    margin: 0;
    width: auto;padding: 10px 8px;
}
.text_area
{
    background: none repeat scroll 0 0 #ffffff;
	border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:95%;
	margin-left:14px;
}
.flash-success
{
    background-color: #fcefd4;
    border: 1px solid #fae1c6;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	background-color: #caeecf;
    border-color: #b7e8b6;
    color: #38b44a;
}
#page .ui-icon {
    display: block !important;
}
.editfieldsdiv{ display:none; }
.foo {   
float: left;
width: 10px;
height: 10px;
margin: 5px 5px 5px 5px;
border-width: 1px;
border-style: solid;
border-color: rgba(0,0,0,.2);
}


.ui-highlight{
background: #C5E8A5 !important;
border-color: #C5E8A5 !important;
color: white !important;
}
.ui-highlight_red
{
background: #FDCBCC !important;
border-color: #FDCBCC !important;
color: white !important;
}
.ui-state-default
{
color:#000000 !important;
font-weight:normal !important;
}

.close123
{

background-image: url() no-repeat 0 0;
}

#page .ait-tabs .ui-tabs-panel {
    background: none repeat scroll 0 0 #fbfbfb !important;
}
.editfieldsdiv{ display:none; }
.foo {   
float: left;
width: 10px;
height: 10px;
margin: 5px 5px 5px 5px;
border-width: 1px;
border-style: solid;
border-color: rgba(0,0,0,.2);
}


.ui-highlight{
background: #C5E8A5 !important;
border-color: #C5E8A5 !important;
color: white !important;
}
.ui-highlight_red
{
background: #FDCBCC !important;
border-color: #FDCBCC !important;
color: white !important;
}
.ui-state-default
{
color:#000000 !important;
font-weight:normal !important;
}

.close123
{
background-image: url() no-repeat 0 0;
}

.error
{
color:#FF0000;
font-weight: normal;
}
.pp_content{ display:table; }
a.pp_close{ position:relative; float:right; }

.pager{ float:right; }
.activitiesplans li {
    
    border-bottom: 1px solid #CCCCCC;
    border-image: none;
    border-left: 0 none;
    border-top: 1px solid #CCCCCC;
    padding: 10px;
	margin-bottom: 20px;
}
.activitiesplans li .leftside{ float:left;  max-width: 70%; }
.activitiesplans li .rightside{ float:right; }
.activitiesplans p{ margin-bottom:0px; }
.activitiesplans li .leftside .title{ font-weight:bold; }

#content {
    margin-left: auto;
    margin-right: auto;
    padding-top: 20px !important;
    width: 1000px;
}

.ui-widget{
    font-family:"ralewayregular" !important;
}
.input_test
{
background: none repeat scroll 0 0 #ffffff;border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:300px;
}
.submit_test
{
 background: none repeat scroll 0 0 #333333;
    border: medium none;
    color: #ffffff;
    cursor: pointer;
    display: inline;
    float: right;
    font-family: arial;
    font-size: 12px;
    font-weight: bold;
    margin: 0;
    width: auto;padding: 10px 8px;
}
.text_area
{
    background: none repeat scroll 0 0 #ffffff;
	border: 2px solid #e8e8e8; color: #666666;
    display: block;
    font-size: 12px;
    margin: 0;
    padding: 10px 8px;width:95%;
	margin-left:14px;
}
.flash-success
{
    background-color: #fcefd4;
    border: 1px solid #fae1c6;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	background-color: #caeecf;
    border-color: #b7e8b6;
    color: #38b44a;
}
#page .ui-icon {
    display: block !important;
}
#fancybox-img
{
 max-height:800px !important;
 max-width:1200px !important;
}

*:before, *:after {
}
*:before, *:after {
}
.modal-header .close {
    margin-top: -2px;
}
button.close {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 0 none;
    cursor: pointer;
    padding: 0;
}
.close {
    color: #000;
    float: right;
    line-height: 1;
    opacity: 1;
    text-shadow: 0 1px 0 #fff;
}

input[type="button"], input[type="button"]:hover {
			background: -moz-linear-gradient(top, #FFFFFF 0%, #FFFFFF 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFFFFF), color-stop(100%,#FFFFFF)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, #FFFFFF 0%,#FFFFFF 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, #FFFFFF 0%,#FFFFFF 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top, #FFFFFF 0%,#FFFFFF 100%); /* IE10+ */
			background: linear-gradient(top, #FFFFFF 0%,#d5e7f3 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FFFFFF', endColorstr='#FFFFFF',GradientType=0 ); /* IE6-9 */
    border: 1px solid #FFFFFF;
    color: #cb202d;
    cursor: pointer;
    left: -6px;
    position: relative;
}
</style>



<script>

jQuery(function() {
jQuery("#datepicker" ).datepicker({});
});
</script>

<!--[if IE]>
<style>
.ui-highlight{
background-color: #C5E8A5 !important;
border-color: #C5E8A5 !important;
color: white !important;
}
.ui-highlight_red
{
background-color: #FDCBCC !important;
border-color: #FDCBCC !important;
color: white !important;
}
.ui-state-default
{
color:#000000 !important;
font-weight:normal !important;
}

#page .ait-tabs .ui-state-default, #page .ait-tabs .ui-state-default, #page .ait-tabs .ui-widget-header .ui-state-default, #page .sc-accordion .ui-state-default, #page .sc-accordion .ui-state-default, #page .sc-accordion .ui-widget-header .ui-state-default {
    filter: progid:DXImageTransform.Microsoft.gradient(enabled='false');
}
 </style>
 
<![endif]-->]

<style>
.ie .ui-highlight{
background-color: #C5E8A5 !important;
border-color: #C5E8A5 !important;
color: white !important;
}
.ie .ui-highlight{
{
background-color: #FDCBCC !important;
border-color: #FDCBCC !important;
color: white !important;
}
.ie .ui-highlight{
{
color:#000000 !important;
font-weight:normal !important;
}
#page .ait-tabs .ui-state-default, #page .ait-tabs .ui-state-default, #page .ait-tabs .ui-widget-header .ui-state-default, #page .sc-accordion .ui-state-default, #page .sc-accordion .ui-state-default, #page .sc-accordion .ui-widget-header .ui-state-default {
   background-color: none repeat scroll 0 0 transparent;
}
</style>
