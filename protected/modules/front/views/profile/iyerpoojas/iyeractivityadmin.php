<div class="style1 alignleft profile-tab" style="width:100%; height:auto;padding-bottom:50px;">
<div style="float:right; margin:20px;">
<a href="<?php echo CController::CreateUrl('profile/create'); ?>" class="btn btn-success btn-large" style="color:#FFFFFF;"><strong>Add Pooja</strong> </a>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'states-grid',
	'dataProvider'=>$iyerpoojas->search(),
	'columns'=>array(
array(
			'name'=>'Category',
			'value'=>'Iyercategories::model()->getname($data->category_id)',
			'type'=>'raw',
		),
		'pooja_name',
		'amount_with_items',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
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


