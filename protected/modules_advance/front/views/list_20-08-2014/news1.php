<?php
$this->widget('CTabView', array(
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'News',
            'view'=>'newstab',
            'data'=>array('dataProvider'=>$dataProvider,'pages'=>$pages),
        ),
        'tab2'=>array(
            'title'=>'Events',
            'url'=>CController::CreateUrl('//front/list/events'),
        ),
    ),
));

?>


