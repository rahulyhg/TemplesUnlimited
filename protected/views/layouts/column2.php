<?php $this->beginContent('//layouts/main'); ?>

<div class="span2">
	<div class="member-box round-all" style="margin-top:20px; padding-bottom:18px;"> 
        <a><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/member_ph.png" class="member-box-avatar" /></a>
        <span>
            <br /><strong style="text-transform:capitalize;"><?php echo Yii::app()->user->name; ?></strong><br />
            <span class="member-box-links"><a href="<?php echo Yii::app()->createAbsoluteUrl('default/config'); ?>">Settings</a> | <a href="<?php echo Yii::app()->createAbsoluteUrl('default/update'); ?>">Password</a> | <a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>">Logout</a></span><br />
        </span>
      </div> 

	<div id="sidebar" class="sidebar-nav">
		<div class="well" style="padding: 8px 0;">
			<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Operations',
					'htmlOptions'=>array('class'=>'nav-header'),
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'nav nav-list'),
				));
				$this->endWidget();
			?>
		</div>
	</div><!-- sidebar -->
</div>

<div class="span10">
	<div id="content">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				 'links'=>$this->breadcrumbs,
                 'homeLink'=>(isset($this->homeUrl) ? $this->homeUrl : CHtml::link('Home',array('site/index'))),
				 'htmlOptions'=>array('class'=>'breadcrumb')
			)); ?><!-- breadcrumbs -->
		<?php endif?>
			
		<?php echo $content; ?>
	</div><!-- content -->
</div>

<?php $this->endContent(); ?>
