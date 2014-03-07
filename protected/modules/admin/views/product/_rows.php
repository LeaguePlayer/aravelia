<!--	--><?php //echo $form->textFieldControlGroup($model,'code',array('class'=>'span8','maxlength'=>20)); ?>
<!---->
<!--	--><?php //echo $form->textFieldControlGroup($model,'article',array('class'=>'span8','maxlength'=>100)); ?>
<!---->
	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>
<!---->
<!--	<div class='control-group'>-->
<!--		--><?php //echo CHtml::activeLabelEx($model, 'wswg_desc'); ?>
<!--		--><?php //$this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_desc', 'config' => array('width' => '100%')
//		)); ?>
<!--		--><?php //echo $form->error($model, 'wswg_desc'); ?>
<!--	</div>-->
<!---->
<!--	--><?php //echo $form->textFieldControlGroup($model,'country',array('class'=>'span8','maxlength'=>255)); ?>
<!---->
<!--	--><?php //echo $form->textFieldControlGroup($model,'group',array('class'=>'span8','maxlength'=>100)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_photos'); ?>
		<?php if ($model->galleryBehaviorPhotos->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorPhotos->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

<!--	--><?php //echo $form->textFieldControlGroup($model,'category_code',array('class'=>'span8','maxlength'=>20)); ?>
<!---->
<!--	--><?php //echo $form->textFieldControlGroup($model,'brand_code',array('class'=>'span8','maxlength'=>20)); ?>

