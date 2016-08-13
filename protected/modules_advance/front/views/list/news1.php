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
<style>

.wrapper
{
margin-top:20px;
margin-bottom:20px;

}
.yiiTab div.view
{
border:1px solid #818181 !important;  
border-radius:5px !important;
}

.yiiTab ul.tabs {
    border-bottom: 0px solid #818181;
    font-family: "ralewayextrabold";
    margin: 0;
    padding: 2px 0;
}
.active
{
border:1px solid  #818181 !important;
}
</style>
<script>
function filterlist(url)
{
$.post(url, $('.filteritem').serialize(), function(data)
{
$('#maincontent124').html(data);
});
}

</script>


