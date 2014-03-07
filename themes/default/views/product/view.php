<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'article',
		'name',
		'wswg_desc',
		'country',
		'group',
		'gllr_photos',
		'category_code',
		'brand_code',
		'create_time',
		'update_time',
	),
)); ?>
