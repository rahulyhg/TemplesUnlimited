<style type="text/css">
.pull-right{ float:right; }
</style>
<div class="post">
	<div class="title">
		<?php echo '<a href="'.Yii::app()->createUrl("//admin/countries/statecreate/id/".$data->idCountry, array()).'" >'.CHtml::htmlButton('<i class="icon-user"></i> New state',
                       array('class' => 'btn btn-large pull-right')).'</a>'; ?>
					   <div class="clear">&nbsp; </div>
	</div>
	
	<div>
	
	</div>
	<div class="content">
		<?php
		$dataProvider=new CActiveDataProvider('State', array('data'=>$data->state));
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			 'columns' => array(
            'idCountry',
            'statename',
			'created',
			array
			(
				'class'=>'CButtonColumn',
				'template'=>'{update}{delete}',
				'buttons'=>array
				(
					'update' => array
					(
						'url'=>'Yii::app()->createUrl("admin/countries/stateupdate", array("id"=>$data->state_id))',
					),
					'delete' => array
					(
						/*'label'=>'Send an e-mail to this user',
						'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',*/
						'url'=>'Yii::app()->createUrl("admin/countries/statedelete", array("id"=>$data->state_id))',
					),
					/*'down' => array
					(
						'label'=>'[-]',
						'url'=>'"#"',
						'visible'=>'$data->state_id > 0',
						'click'=>'function(){alert("Going down!");}',
					),*/
				),
			),
        ),

		));
		
		?>
	</div>
	<div class="nav">
		
	</div>
</div>
