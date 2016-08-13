<div class="rule"></div>

<?php  $user = User::model()->findByAttributes(array('email'=>$data->email)); 

     if(isset($user->user_image)) 
     $image = helpers::view_userimage($user->user_image,'thumb',array('class'=>'reviewowerimage','style'=>'width:84px;height:84px;'));
     else
     $image ='';
?>

<div class="sc-page shadow">
        <div class="item clearfix shadow">
            <?php if(isset($user->user_image)){ ?>
         <div class="image"><a href="" class="greyscale"><?php echo $image; ?></a></div>
            <?php } else { ?>
         <div class="image"><a href="" class="greyscale"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/user.png" class="attachment-thumbnail wp-post-image"></a></div>
            <?php } ?>	 
       <div class="text">
        Name  : <strong><?php echo $data->name; ?></strong>
		<br />
		Email : <strong><?php echo $data->email; ?></strong>
		<br />
		Phone No : <strong><?php echo $data->ph_no; ?></strong>
        <br />
		Question : <strong><?php echo $data->question; ?></strong>
       <br />

		<div>
	<a style="background-color: #CB202D; color: #fff;  font-style:bold; font-size:13px; margin-left:5px; border-radius:3px" onclick="chooseoption1('<?php echo $data->id; ?>');" class="sc-button light right" href="javascript:void(0);">Delete</a>

		</div>
        </div>
        </div></div>

</div>
<script>
function chooseoption1(id)
{
var r = confirm("Are you sure, you want to delete this notification?");
if (r == true) {
$.ajax({
url :'<?php echo $this->createUrl('detail/deletequeries'); ?>',
type : "post",
data : "id="+id,
success:function(data)
{
window.location.reload();
} 
});
}
}
</script>
<style>
.items .item {
    background: none repeat scroll 0 0 #ffffff;
    margin-bottom: 20px;
    padding: 0;
}
</style>
