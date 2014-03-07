<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller
{
    public $layout='//layouts/simple';
    public $menu=array();
    public $breadcrumbs=array();
    public $cat = array();

    public function init() {
        parent::init();
        $this->title = Yii::app()->name;

        // Формируем верхнее меню
        // Формируем меню для девочек
        $query = "SELECT
                    DISTINCT(c.value_from)
                FROM
                    tbl_products as p
                RIGHT JOIN
                    tbl_balances as b
                ON
                    p.code=b.product_code
                RIGHT JOIN
                    tbl_characteristics as c
                ON
                    b.characteristic_code=c.code
                WHERE
                    p.`group`='Девочка'
                ORDER BY
                    c.value_from ASC";
        $charac['girls'] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
        if($charac['girls']){
            foreach($charac["girls"] as $ch){
                $query = "SELECT
                        distinct(cat.id),
                        cat.name
                    FROM
                        tbl_categories as cat
                    RIGHT JOIN
                        tbl_products as p
                    ON
                        cat.code=p.category_code
                    LEFT JOIN
                        tbl_balances as b
                    ON
                        b.product_code=p.code
                    LEFT JOIN
                        tbl_characteristics as c
                    ON
                        c.code=b.characteristic_code
                    WHERE
                        c.value_from={$ch['value_from']}
                    ORDER BY
                        cat.name ASC";
                $cat["girls"][$ch['value_from']] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
            }
        }

        $this->cat = $cat;
    }

    //Check home page
    public function is_home(){
        return $this->route == 'site/index';
    }

    public function beforeRender($view)
    {
        $this->renderPartial('//layouts/clips/_main_menu');
        return parent::beforeRender($view);
    }
}