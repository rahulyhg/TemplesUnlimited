<?php
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';

$categories =Storecategories::model()->getall(); 

$options ='<option value="">-- Please Select --</option>';

for($i=0;$i<count($categories);$i++)
{
$options .='<option value='.$categories[$i]->category_id.'>'.$categories[$i]->category_name.'</option>';
}


?>

<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/products'); ?>">&nbsp;Store</a></h3>
</div>
</div>

<div id="main" class="mainpage onecolumn">





   <div class="wrapper" >
   <h3 class="epooja">Store</h3>

		<form style="width:100%; margin-top:20px;" method="post" action="" class="filteritem12345">
		<div class="sc-column one-third">
		<select style="padding:2%; width:50%" name="categories" id="categories">
		<?php echo $options; ?>
		</select>
		<span id="directory-search" class="dir-searchsubmit">
		<input type="button" style="margin-left:5px; width:30%; font-size:14px;" class="dir-searchsubmit" value="Search" onclick="filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
		</span>
		</div>
		</form>

		<div id="ait-login-tabs">
		<div class="wrapper">
		<ul class="tabbing" style="float:right; padding-right:10px;">
		<li><a href="<?php echo CController::CreateUrl('/front/list/products'); ?>" class="login"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png"  title="Grid View"></a></li>
  <li class="active"><a href="#ait-dir-register-tab" class="register"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png"  title="List View"></a></li>
		</ul>
		</div>	
		</div>
   </div>
   
   

	
	<div id="ait-dir-register-tab">
				
				<div class="latest-posts wrapper" style="margin-top:30px; margin-bottom:30px;">
				
				
								
<?php  $dataProvider->pagination->pageSize=12; ?>
				<?php  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'emptyText' => "We're sorry, no product's found for this category. Try refining this category above to get more results.",
				'itemView'=>'_product_list_view',
				'template'=>'{items}{pager}',
				'ajaxUpdate'=>true,
				'ajaxUrl'=>array($this->getRoute()),
			));
			
			
			$this->widget('CLinkPager', array(
					'currentPage'=>$pages->getCurrentPage(),
					'itemCount'=>$items_count,
					'pageSize'=>$page_size,
					'header'=>'',
					'htmlOptions'=>array('style'=>'float:right; margin-bottom:20px; margin-top:-30px;'),
					));
					?>
				
				

				
				</div>
				</div>
				 </div>
  
  <style>

ul.yiiPager a:link, ul.yiiPager a:visited {
    color: #040404 !important;
}
  </style>
<script>
function filterlist2(url)
{
$.post(url, $('.filteritem12345').serialize(), function(data)
{
$('#ait-dir-register-tab').html(data);
});

}
</script>
  


