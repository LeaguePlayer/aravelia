<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление товарами</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('product')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'article',
		'name',
		'group',
		'gllr_photos',
        array(
            'name'=>'category.name',
            'filter' => CHtml::activeTextField($model->searchCat, 'name')
        ),
        array(
            'name'=>'brand.name',
            'filter' => CHtml::activeTextField($model->searchBrand, 'name')
        ),
//		array(
//			'name'=>'create_time',
//			'type'=>'raw',
//			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
//		),
//		array(
//			'name'=>'update_time',
//			'type'=>'raw',
//			'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
//		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("product");', CClientScript::POS_END) ;?>