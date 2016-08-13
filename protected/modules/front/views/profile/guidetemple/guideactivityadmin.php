<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">
<div style="float:right; margin:20px;">
<a href="<?php echo CController::CreateUrl('profile/templecreate'); ?>" class="btn btn-success btn-large" style="color:#FFFFFF;"><strong>Add Activity</strong> </a>
</div>
<?php
$guideactivities = new Guidetemple;


 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'states-grid',
	'dataProvider'=>$guideactivities->searchByAttr(),
	'columns'=>array(
	/*array(
			'name'=>'Category',
			'value'=>'Guidecategories::model()->getname($data->category_id)',
			'type'=>'raw',
		),*/
		'category_id',
		array(
			'name'=>'Temple Name',
			'value'=>'$data->activity_title',
			'type'=>'raw',
		),
		
		'amount',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			
			
					'buttons'=>array
					(
					'view' => array
					(
					'url'=>'Yii::app()->createUrl("front/profile/templeview", array("id"=>$data->activity_id))',
					),
					'update' => array
					(
					'url'=>'Yii::app()->createUrl("front/profile/templeguideupdate", array("id"=>$data->activity_id))',
					),
					'delete' => array
					(
					'url'=>'Yii::app()->createUrl("front/profile/templeguidedelete", array("id"=>$data->activity_id))',
					),
					
					
					),
			
			
			
			
		),
	),
)); ?>



</div>

<style>
.grid-view table.items th, .grid-view table.items td {
    border: 1px solid white;
    font-size: 0.9em;
    padding: 0.3em;
    width: 30%; 
}
.summary
{
display:none;
}
.grid-view table.items {
    background: none repeat scroll 0 0 white;
    border: 1px solid #d0e3ef;
    border-collapse: collapse;
    width: 96%;
	margin-left:2%;
}
.grid-view table.items th {
    text-align: left;
}
</style>


