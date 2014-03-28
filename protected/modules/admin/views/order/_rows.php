    <div class="control-group">
        <label class="control-label" for="Order_type">Тип заказа</label>
        <div class="controls"><span class="input-xlarge uneditable-input"><?=Order::getTypeLabel($model->type)?></span></div>
    </div>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'phone',array('class'=>'span8','maxlength'=>20)); ?>

	<?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaControlGroup($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'payment',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'delivery',array('class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Order::getStatusLabel(), array('class'=>'span8', 'displaySize'=>1)); ?>
