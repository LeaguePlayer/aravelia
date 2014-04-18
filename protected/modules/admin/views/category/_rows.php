	<?php echo $form->textFieldControlGroup($model,'code',array('class'=>'span8','maxlength'=>20, 'disabled'=>true)); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255, 'disabled'=>true)); ?>

    <?
    $data = Categorytype::getData();
    $data[0] = "Выберите тип";
    ?>
    <?=$form->label($model,'type_id');?>
    <?=$form->dropDownList($model, 'type_id', Categorytype::getData());?>
    <?=$form->error($model, 'type_id')?>
