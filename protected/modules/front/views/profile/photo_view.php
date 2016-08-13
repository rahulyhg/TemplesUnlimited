<div class="sc-page myphoto<?php echo $data->image_id; ?>">
	<div class="item clearfix payment" style="background-color:transparent; margin-bottom:0px;">
	
	
		
			<div class="title right" style="padding-top:20px;"><a href="javascript:void(0);"  onclick="removephoto('<?php echo $data->image_id; ?>');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/close.gif">&nbsp;&nbsp;Remove</a></div>
			
				<div class="title right" style="padding-top:20px; margin-right:20px"><a href="javascript:void(0);"  onclick="makeusprimaryphoto('<?php echo $data->image_id; ?>');" ><input type="radio" name="primary" <?php if($data->make_as_primary=='1') { ?>checked="checked"  <?php } ?>/>Make as Primary</a></div>
				
		<div class="image">
		
		<a href="<?php echo Yii::app()->request->baseUrl.'/'.$data->image_path; ?>" rel="prettyPhoto[gallery]">
		<?php echo helpers::view_thumb($data->image_path,array("width"=>"150px","height"=>"150px","alt"=>$data->image_caption,"class"=>"attachment-thumbnail")); ?>		</a>
		</div><div class="text">
			<div class="title"><h3><a href="javascript:void(0);"><?php echo $data->image_caption; ?></a></h3>
		
			</div>
		<div class="sc-column one-fourth">
			
			<div class="left"> 
			<div class="left"><strong>&nbsp;</strong>&nbsp;</div>
			<div class="right"></div>
			</div>	
			
			
			<div class="right"></div>		
			
		</div>
		
			
		
		<!-- /.text --></div></div>

</div>
	
	
	<div class="rule"></div>	
		
