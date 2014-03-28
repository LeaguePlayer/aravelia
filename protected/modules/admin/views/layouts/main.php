<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title><?php echo CHtml::encode(Yii::app()->config->get('app.name')).' | Admin';?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
        <?php
            $menuItems = array(
                array(
                    'label'=>'Структура',
                    'items'=>array(
                        array('label'=>'Разделы сайта', 'url'=>array('/admin/structure')),
                        array('label'=>'Меню сайта', 'url'=>array('/admin/menu')),
                    ),
                ),
                array(
                    'label'=>'Материалы',
                    'items'=>array(
                        array('label'=>'Товары', 'url'=>array('/admin/product')),
                        array('label'=>'Сертификаты', 'url'=>array('/admin/certificate')),
                        array('label'=>'Отзывы', 'url'=>array('/admin/review')),
                    ),
                ),
//                array('label'=>'Материалы', 'url'=>array('/admin/material')),
                array('label'=>'Заказы('.$this->new_order.')', 'url'=>array('/admin/order')),
                array(
                    "label"=>"Клуб",
                    "items"=>array(
                        array('label'=>'События', 'url'=>array('/admin/action')),
                        array('label'=>'Заявки', 'url'=>array('/admin/club')),
                    ),
                ),
                array('label'=>'Настройки', 'url'=>array('/admin/config')),
            );
        ?>
        <?php
            $userlogin = Yii::app()->user->name ? Yii::app()->user->name : Yii::app()->user->email;
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'color'=>'inverse', // null or 'inverse'
                'brandLabel'=> CHtml::encode(Yii::app()->name),
                'brandUrl'=>'/',
                'collapse'=>true, // requires bootstrap-responsive.css
                'items'=>array(
                    array(
                        'class'=>'bootstrap.widgets.TbNav',
                        'items'=>$menuItems,
                    ),
                    array(
                        'class'=>'bootstrap.widgets.TbNav',
                        'htmlOptions'=>array('class'=>'pull-right'),
                        'items'=>array(
                            array('label'=>'Выйти ('.$userlogin.')', 'url'=>'/user/logout'),
                        ),
                    ),
                ),
            ));
        ?>

        <?php echo $content;?>

	</body>
</html>
