<?php 
if(isset($_REQUEST['vt']))
$urlextra = '/vt/'.$_REQUEST['vt'];
else
$urlextra = '';


 $categories =Poojacategories::model()->getall(); 
 
$options ='<option value="all">All</option>';

 for($i=0;$i<count($categories);$i++)
 {
  $options .='<option value='.$categories[$i]->category_id.'>'.$categories[$i]->category_name.'</option>';
 }
 $pooja =Pooja::model()->getall(); 

?>


<div style="margin-top:15px;">
<div class="wrapper" >
<h3 class="left" style="font-size:13px; text-align:left; font-weight:bold;"><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span style="color:#c1c1c1;">&nbsp; >>&nbsp;</span><a  href="<?php echo CController::CreateUrl('/epooja'); ?>">&nbsp;E-pooja</a></h3>
</div>
</div>

<div class="wrapper"><h3 class="epooja">E-pooja and Services</h3></div>
<div class="wrapper">

<form style="width:95%; margin-bottom:60px; margin-top:25px; padding-left:10px;" method="post" action="" class="wp-user-form">
<div class="sc-column one-half">
				<select style="padding:2%; width:37%;font-family:'ralewayregular' !important;" name="epooja_category" id="epooja_category" class="filteritem123" onchange="filterlist1('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						<?php echo $options; ?>
						</select>


						<input type="text" placeholder="Search Keyword..." style="padding:2%; width:32%;margin-left:10px;" name="title" id="title" class="filteritem12345" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''; ?>"> 
						<span id="directory-search" class="dir-searchsubmit">
						<input type="button" style="margin-left:5px; width:18%; font-size:14px;background-color: #cb202d;" class="dir-searchsubmit" value="Search"  onclick="filterlist2('<?php echo CHtml::normalizeUrl(array('/'.$this->getRoute())); ?>')">
						</span>
						
</div>
						
</form>

<div class="widget_tab">


			<div id="ait-login-tabs">
			<div class="wrapper" style="margin-top:-25px;">
			
			
				<ul class="tabbing" style="float:right; padding-right:10px;">
		<li class="active"><a href="<?php echo CController::CreateUrl('/front/list/epooja'); ?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tiles1.png" title="Grid View"></a></li>
					<li ><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/list1.png"  title="List View"></a></li>
				</ul>
			</div>
				<!-- login -->
				<div id="ait-dir-login-tab"   style="display: none; margin-top:20px;"></div>

				<!-- register -->
				<div id="ait-dir-register-tab" style="margin-top:20px;" >
				
				<div class="latest-posts wrapper">
				<p></p>
				
<?php  $dataProvider->pagination->pageSize=12; ?>
				<?php  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_pooja_list',
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
</div>
<style>
ul.yiiPager a:link, ul.yiiPager a:visited 
{
    color: #040404 !important;

}
.items .item {
    background: none repeat scroll 0 0 #ffffff;
    margin-bottom: -20px;
    padding: 0;
}
.ie9 .dir-searchsubmit
{
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#cb202d', endColorstr='#cb202d');
}
</style>

<script>
function filterlist1(url)
{
$('#title').val('');
$.post(url, $('.filteritem123').serialize(), function(data)
{
$('#ait-dir-register-tab').html(data);
});
}



function filterlist2(url)
{
var title =  $('#title').val();
if(title=='')
{
alert('Please enter title');
}
else
{
$('#epooja_category').val('');
$.post(url, $('.filteritem12345').serialize(), function(data)
{
$('#ait-dir-login-tab').html(data);
});
}
}
</script>

<script>
$('#title').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : '<?php echo $this->createUrl('list/epoojaauto'); ?>',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
						},
						 success: function( data ) {
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });		
 </script>
