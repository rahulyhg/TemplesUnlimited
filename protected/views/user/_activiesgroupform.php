<div class="activitiesgroupform  activitiesgroupform<?php echo $key; ?><?php echo $g; ?>">
<?php if((int)$g>1){ ?>
<input type="buttton" value="Remove" class="btn btn-danger btn-small pull-right" onclick="remove_div('activitiesgroupform<?php echo $key; ?><?php echo $g; ?>')" />
<?php } ?>
				 <h5>Group <?php echo $g; ?></h5>	
				   <?php  $k = '1';   ?>			
				  <div class="activitiesgroupmemberforms"  id="<?php echo $key; ?><?php echo $g; ?><?php echo $k; ?>">
				  <input type="button" class="btn btn-success pull-right get_Guide_group_member_form<?php echo $key; ?><?php echo $g; ?><?php echo $k; ?>" value="Add more member" data-name="<?php echo 'Guideactivities['.$key.'][activity_plans][type]['.$g.'][member]'; ?>" />	
				
								 <div class="activitiesgroupmemberform activitiesgroupmemberform<?php echo $g; ?><?php echo $k; ?>">
										 <div class="control-group">										
										<label><?php echo 'member '.$k.' price'; ?></label>
										 <div class="controls">
										<input type="text" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type]['.$g.'][member]['.$k.']'; ?>" required="required" />
										</div>
									   </div>
							   </div>
				   </div>
		 </div>
		 <script type="text/javascript">
		 $(function(){
		   $('.activitieslists .get_Guide_group_member_form<?php echo $key; ?><?php echo $g; ?><?php echo $k; ?>').click(function(){
															var key1 = parseInt($(this).parent().attr('id'));
															key1++;
															var key6 = parseInt(<?php echo $key; ?><?php echo $g; ?>)*10;
															$(this).parent().attr('id',key1);
															key1 = key1-key6;
															$(this).parent().append('<div class="activitiesgroupmemberform activitiesgroupmemberform<?php echo $g; ?>'+key1+'"><div class="control-group"><label>member '+key1+' price</label><div class="controls"><input type="text" name="'+$(this).attr('data-name')+'['+key1+']" required="required" /><input type="buttton" value="Remove" class="btn btn-danger btn-small pull-right" onclick="remove_div(\'activitiesgroupmemberform<?php echo $g; ?>'+key1+'\')" /></div></div></div>');
															});
		   });
		 </script>
