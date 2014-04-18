	<?php echo $form->textFieldControlGroup($model,'size',array('class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'desc',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model,'type_id',Categorytype::getData()); ?>

	<?php echo $form->dropDownListControlGroup($model, "group_id", Size::getGroup()); ?>

