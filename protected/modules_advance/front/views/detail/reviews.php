<?php // if(Yii::app()->user->isGuest || (!Yii::app()->user->isGuest  && Yii::app()->user->id != $reviews->review_itemid )){ ?>
<div class="rule"></div>
<div class="closeable">
		
<div id="comments">


<!--<h2 id="comments-title">
One thought on &ldquo;<span>Rameshwaram temple</span>&rdquo;		</h2>


<ol class="commentlist">
	<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">

<article id="comment-9" class="comment">

<div class="comment-content clearfix">
	<div class="comment-avatar left"><img alt='' src='http://1.gravatar.com/avatar/f0781076fe847372a8f0239c42ecd347?s=68&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D68&amp;r=G' class='avatar avatar-68 photo' height='68' width='68' /></div>
		<p>Brand new comment</p>

</div>

<div class="comment-meta clearfix">
	<div class="meta-info author vcard left"><cite class="fn">admin</cite></div>
	<div class="meta-info date left"><a href="" class="comment-date"><time pubdate datetime="2013-08-22T12:05:04+00:00">August 22, 2013 at 12:05 pm</time></a></div>

	<div class="meta-controls reply right"><a class='comment-reply-link' href='/businessfinder/wp1/contact/?replytocom=9#respond' onclick='return addComment.moveForm("comment-9", "9", "respond", "4177")'>Reply</a></div>
	<div class="meta-controls edit right"></div>
</div>

</article>
</li></ol>
-->

								<div id="respond" class="comment-respond">								
				<h3 id="reply-title" class="comment-reply-title">Leave a Review <small><a rel="nofollow" id="cancel-comment-reply-link" href="" style="display:none;">Cancel reply</a></small></h3>
				
				<?php if(Yii::app()->user->hasFlash('reviewsuccess')){ ?>
				 <div class="flashmessage success flashmessage-review">
					<button class="close" data-dismiss="alert">X</button>
					<p><?php echo Yii::app()->user->getFlash('reviewsuccess'); ?></p>
				</div>
				<?php } ?>
									
						<?php $form=$this->beginWidget('CActiveForm', array(
									'id'=>'commentform',
									'enableAjaxValidation'=>true,
										'enableClientValidation'=>true,
										'clientOptions' => array(
												'validateOnSubmit'=>false,
												'validateOnChange'=>false,
												'validateOnType'=>false,
										),
									'action'=>CController::CreateUrl('//front/review/post'),
									'htmlOptions'=>array('class'=>'comment-form'),
									)); ?>
								
						<div class="" id="ait-rating-system" style="width:30%; float:left">
						<div class="rating-send-form" style="border:none;background:none;box-shadow:none;">		
					<div class="">
					<div style="margin-bottom:-20px; margin-right:10px; margin-top:5px;" class="left"><p class="rating_review"><strong> Ratings : </strong></p></div>								
									<div data-rated-value="0" data-rating-id="1" class="rating clearfix" style="margin-top: 9px;">
						                      <div class="stars clearfix">
																	<div data-star-id="1" class="star" onclick="ratingstar('1')"></div>
																	<div data-star-id="2" class="star" onclick="ratingstar('2')"></div>
																	<div data-star-id="3" class="star" onclick="ratingstar('3')"></div>
																	<div data-star-id="4" class="star" onclick="ratingstar('4')"></div>
																	<div data-star-id="5" class="star" onclick="ratingstar('5')"></div>
												  </div>
							       </div>
				</div><!-- .rating-inputs -->
		</div>	<!-- .rating-send-form -->	
</div>

				<div style="clear:both;"></div>		
			
																										
<p class="comment-form-url">
                   <label for="url"><span class="required">*</span></label> 
                                                 <?php echo $form->textField($reviews,'review_title',array('style'=>'45%','placeholder'=>'Your Review Title here..')); ?></p>
												<p class="comment-form-comment"><label for="comment"><span class="required">*</span></label> 
												  <?php echo $form->textArea($reviews,'review_content',array('cols'=>'45','rows'=>'8','aria-required'=>true,'placeholder'=>'Write Your Review here..')); ?></p>
												<p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></p>						
												

                                           <?php echo $form->hiddenField($reviews,'review_itemtype',array('required'=>true)); ?>
										   <?php echo $form->hiddenField($reviews,'review_itemid',array('required'=>true)); ?>
										   <?php echo $form->hiddenField($reviews,'review_rate',array('required'=>true)); ?>
				
			
			
			<p class="review-submit" style="text-align:right;">
				<input type="hidden" value="" name="redirect_to" id="redirect_to">
	<?php if(Yii::app()->user->isGuest){ 
	               
						
						echo '<div class="loggerinactionbox" style="display:none;">';
						  echo CHtml::ajaxSubmitButton(
                                'Post Review',
								array('//front/review/post'),
															array(  
											'beforeSend' => 'function(){ 
																		 $("#submit").attr("disabled",true);
																		 $("#commentform .errorMessage").html("");
										}',
																	'complete' => 'function(){ 
																		 $("#commentform").each(function(){ }); //this.reset();
																		 $("#submit").attr("disabled",false);
																	}',
											   'success'=>'function(data){  
																		 var obj = jQuery.parseJSON(data); 
																		 if (data.indexOf("{")==0) {
																		    jQuery("#Reviews_review_title, #Reviews_review_content, .stars").removeClass("requirederror");
																		    jQuery.each(obj, function(key, value) { jQuery("#"+key).addClass("requirederror"); if(key == "Reviews_review_rate"){ jQuery(".stars").addClass("requirederror"); } });
																		 }
																		
																		 if(obj.review == "success"){
																		    window.location.reload();
																		   //reviewsubmitsuccess(obj.msg);
																          }
								
							 
																	}' 
								),
													 array("id"=>"submit","class" => "button-primary",'style'=>'float: right;')      
											); 
					echo '</div>';	
					
					 echo '<div class="notloggerinactionbox">';
	                     echo CHtml::Button('Post Review',array("id"=>"submit","class" => "button-primary tootltiptrigger triggerlogin",'title'=>'Please login to submit review.','style'=>'float: right;','data-type'=>"review"));
					echo '<div class="clear">&nbsp;</div></div>';						
				}else{
				 echo CHtml::ajaxSubmitButton(
                                'Post Review',
								array('//front/review/post'),
															array(  
											'beforeSend' => 'function(){ 
																		 $("#submit").attr("disabled",true);
																		 $("#commentform .errorMessage").html("");
										}',
																	'complete' => 'function(){ 
																		 $("#commentform").each(function(){ }); //this.reset();
																		 $("#submit").attr("disabled",false);
																	}',
											   'success'=>'function(data){  
																		 var obj = jQuery.parseJSON(data); 
																		 if (data.indexOf("{")==0) {
																		    jQuery("#Reviews_review_title, #Reviews_review_content, .stars").removeClass("requirederror");
																		    jQuery.each(obj, function(key, value) { jQuery("#"+key).addClass("requirederror"); if(key == "Reviews_review_rate"){ jQuery(".stars").addClass("requirederror"); } });
																		 }
																		
																		 if(obj.review == "success"){
																		    window.location.reload();
																		   //reviewsubmitsuccess(obj.msg);
																          }
								
							 
																	}' 
								),
													 array("id"=>"submit","class" => "button-primary")      
											); 
				
				}?>
			</p>

		  <?php $this->endWidget(); ?>
											
									
							</div><!-- #respond -->
			
</div><!-- #comments -->

</div> 			<!-- /.closeable -->
<style type="text/css">
.requirederror {
    border: 2px solid #FF0000 !important;
}
.stars.requirederror{
    padding:10px;
    border: 2px solid #FF0000 !important;
}
</style>
<?php //} ?>