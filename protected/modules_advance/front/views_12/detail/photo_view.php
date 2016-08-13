
<dl class="gallery-item sc-column one-fourth">
			<dt class="gallery-icon landscape">
			<a href="<?php echo Yii::app()->request->baseUrl.'/'.$data->image_path; ?>" rel="prettyPhoto[gallery]">
		<?php echo helpers::view_thumb($data->image_path,array("width"=>"150px","height"=>"150px","alt"=>$data->image_caption,"class"=>"attachment-thumbnail")); ?>		</a>
			</dt>
				<dd class="wp-caption-text gallery-caption">
			<?php echo helpers::show_minimize($data->image_caption,15); ?>
				</dd></dl>