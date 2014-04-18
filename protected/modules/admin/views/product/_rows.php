	<?php echo $form->hiddenField($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<p><b>Фото</b></p>
		<?php if ($model->galleryBehaviorPhotos->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorPhotos->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>
    <p><b>Характеристики</b></p>
    <table class="table table-striped">
        <tr>
            <td>Код в 1С</td>
            <td><?=$model->code?></td>
        </tr>
        <tr>
            <td>Артикул</td>
            <td><?=$model->article?></td>
        </tr>
        <tr>
            <td>Название</td>
            <td><?=$model->name?></td>
        </tr>
        <tr>
            <td>Категория</td>
            <td><?=$model->category->name?></td>
        </tr>
        <tr>
            <td>Бренд</td>
            <td><?=$model->brand->name?></td>
        </tr>
        <tr>
            <td>Описание</td>
            <td><?=$model->wswg_desc?></td>
        </tr>
        <tr>
            <td>Страна</td>
            <td><?=$model->country?></td>
        </tr>
        <tr>
            <td>Группа</td>
            <td><?=$model->group?></td>
        </tr>
    </table>

