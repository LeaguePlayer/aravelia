	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_content'); ?>
		<?php $this->widget('appext.ckeditor.CKEditorWidget', array(
            'model' => $model,
            'attribute' => 'wswg_content',
		)); ?>
		<?php echo $form->error($model, 'wswg_content'); ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Page::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
