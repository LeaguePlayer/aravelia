<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller
{
    public $layout='//layouts/simple';
    public $menu=array();
    public $mainMenu=array();
    public $subMenu=array();
    public $breadcrumbs=array();
    public $cat = array();
    public $brands = array();
    public $bottomMenu = array();

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
                        cat.id IS NOT NULL AND c.value_from={$ch['value_from']}
                    ORDER BY
                        cat.name ASC";
                $cat["girls"][$ch['value_from']] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
            }
        }

        // Формируем верхнее меню
        // Формируем меню для мальчик
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
                    p.`group`='Мальчик'
                ORDER BY
                    c.value_from ASC";
        $charac['boys'] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
        if($charac['boys']){
            foreach($charac["boys"] as $ch){
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
                        cat.id IS NOT NULL AND c.value_from={$ch['value_from']}
                    ORDER BY
                        cat.name ASC";
                $cat["boys"][$ch['value_from']] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
            }
        }

        // Формируем верхнее меню
        // Формируем меню для Малышей
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
                    p.`group`='Малыши'
                ORDER BY
                    c.value_from ASC";
        $charac['childs'] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
        if($charac['childs']){
            foreach($charac["childs"] as $ch){
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
                        cat.id IS NOT NULL AND c.value_from={$ch['value_from']}
                    ORDER BY
                        cat.name ASC";
                $cat["childs"][$ch['value_from']] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
            }
        }

        // формируем список брендов для девочек
        $query = "SELECT
                        distinct(b.id) id,
                        b.code code,
                        b.name name
                    FROM
                        tbl_products as p
                    LEFT JOIN
                        tbl_brands as b
                    ON
                        p.brand_code=b.code
                    WHERE
                        p.`group`='Девочка'
                    ORDER BY b.name";
        $brands['girls'] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();

        // формируем список брендов для мальчиков
        $query = "SELECT
                        distinct(b.id) id,
                        b.code code,
                        b.name name
                    FROM
                        tbl_products as p
                    LEFT JOIN
                        tbl_brands as b
                    ON
                        p.brand_code=b.code
                    WHERE
                        p.`group`='Мальчик'
                    ORDER BY b.name";
        $brands['boys'] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();

        // формируем список брендов для малышей
        $query = "SELECT
                        distinct(b.id) id,
                        b.code code,
                        b.name name
                    FROM
                        tbl_products as p
                    LEFT JOIN
                        tbl_brands as b
                    ON
                        p.brand_code=b.code
                    WHERE
                        p.`group`='Малыши'
                    ORDER BY b.name";
        $brands['childs'] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();

        // формируем элементы для нижнего меню
        if($cat["girls"]){
            $count = 0;
            $key = 0;
            foreach($cat["girls"] as $k=>$cg){
                if(count($cg)>$count){
                    $key = $k;
                    $count = count($cg);
                }
            }
            $this->bottomMenu["girls"] = $cat["girls"][$key];
        }
        if($cat["boys"]){
            $count = 0;
            $key = 0;
            foreach($cat["boys"] as $k=>$cg){
                if(count($cg)>$count){
                    $key = $k;
                    $count = count($cg);
                }
            }
            $this->bottomMenu["boys"] = $cat["boys"][$key];
        }
        if($cat["childs"]){
            $count = 0;
            $key = 0;
            foreach($cat["childs"] as $k=>$cg){
                if(count($cg)>$count){
                    $key = $k;
                    $count = count($cg);
                }
            }
            $this->bottomMenu["childs"] = $cat["childs"][$key];
        }
        $query = "SELECT
                        distinct(b.id) id,
                        b.code code,
                        b.name name
                    FROM
                        tbl_products as p
                    LEFT JOIN
                        tbl_brands as b
                    ON
                        p.brand_code=b.code
                    ORDER BY b.name";
        $this->bottomMenu["brands"] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();


        $this->brands = $brands;
        $this->cat = $cat;
        $this->buildMenu();
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

    public function buildMenu($currentNode = null)
    {
        $root = Menu::model()->cache(3600)->findByAttributes(array(
            'level' => 1
        ));
        if ( !$root ) return;
        $criteria = new CDbCriteria();
        $criteria->compare('status', 1);
        $criteria->addCondition('level<4');

        $items = $root->descendants()->cache(3600)->findAll($criteria);
        $mainActiveId = 0;
        $subActiveId = 0;

        if ( $currentNode ) {
            foreach ( $items as $item ) {
                if ( $item->level == 2 && $item->node_id == $currentNode->id ) {
                    $mainActiveId = $item->id;
                    break;
                }
                if ( $item->level == 3 && $item->node_id == $currentNode->id ) {
                    $subActiveId = $item->id;
                    $mainActiveId = $item->parent_id;
                    break;
                }
            }
        }

        foreach ( $items as $item ) {
            if ( $item->level == 2 ) {
                $this->mainMenu[] = array(
                    'active' => $item->id === $mainActiveId,
                    'label' => $item->name,
                    'url' => $item->getUrl(),
                    'class' => $item->item_class,
                );
                continue;
            }
            if ( $item->level == 3 && $item->parent_id === $mainActiveId ) {
                $this->subMenu[] = array(
                    'active' => $item->id === $subActiveId,
                    'label' => $item->name,
                    'url' => $item->getUrl(),
                    'class' => $item->item_class,
                );
                continue;
            }
        }
    }
}