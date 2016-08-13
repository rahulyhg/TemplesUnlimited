<?php

$this->widget('CTabView', array(
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'News',
			'url'=>CController::CreateUrl('//front/list/news'),
        ),
        'tab2'=>array(
            'title'=>'Events',
			'view'=>'eventstab',
            'data'=>array('dataProvider'=>$dataProvider,'pages'=>$pages),
        ),
    ),
));

?>


