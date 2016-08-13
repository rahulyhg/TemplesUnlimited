<div class="activitiespersonform  activitiespersonform<?php echo $key; ?><?php echo $p; ?>">
<?php if((int)$p>1){ ?>
<!--<input type="buttton" value="Remove" class="btn btn-danger span2 btn-small pull-right" onclick="remove_div('activitiespersonform<?php echo $key; ?><?php echo $p; ?>')" />-->
<?php } ?>
				 <h5>Price Plan <?php //echo $p; ?></h5>	
				 
										<!-- <div class="control-group">										
										<label><?php echo 'person '.$p.' title'; ?></label>
										 <div class="controls">
										
										</div>
									   </div>-->
									   <input type="hidden" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][1][title]'; ?>"  value="Adult (Age 16 - 64)"/>
									   <div class="control-group">										
										<label>Adult (Age 16 - 64)</label>
										 <div class="controls">
										<input type="text" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][1][price]'; ?>" required="required" />
										</div>
									   </div>
									   
									    <input type="hidden" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][2][title]'; ?>"  value="Child (Age 5 - 15)"/>
									   <div class="control-group">										
										<label>Child (Age 5 - 15)</label>
										 <div class="controls">
										<input type="text" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][2][price]'; ?>" required="required" />
										</div>
									   </div>
									   
									    <input type="hidden" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][3][title]'; ?>"  value="Infant (Age 0 - 4)"/>
									   <div class="control-group">										
										<label>Infant (Age 0 - 4)</label>
										 <div class="controls">
										<input type="text" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][3][price]'; ?>" required="required" />
										</div>
									   </div>
									   
									    <input type="hidden" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][4][title]'; ?>"  value="Senior (Age 65+)"/>
									   <div class="control-group">										
										<label>Senior (Age 65+)</label>
										 <div class="controls">
										<input type="text" name="<?php echo 'Guideactivities['.$key.'][activity_plans][type][4][price]'; ?>" required="required" />
										</div>
									   </div>
							   
		 </div>
		
