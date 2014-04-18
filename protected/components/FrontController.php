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

//        Yii::app()->cache->flush();

        $this->title = Yii::app()->name;

        // получаем типы категорий
        $query = "SELECT
                    *
                FROM
                    tbl_category_type as ct
                ORDER BY ct.sort ASC";
        $cattype = Yii::app()->db->createCommand($query)->queryAll();

        foreach($cattype as $ct){
            // получаем размеры девочек
            $cat["girls"][$ct["id"]] = $ct;
            $cat["girls"][$ct["id"]]["sizes"] = Yii::app()->db->cache(86400)->createCommand()
                ->select("*")
                ->from("tbl_sizes")
                ->where(array("and", "type_id={$ct["id"]}", "group_id=0"))
                ->order("size ASC")
                ->queryAll();
            // получаем размеры мальчиков
            $cat["boys"][$ct["id"]] = $ct;
            $cat["boys"][$ct["id"]]["sizes"] = Yii::app()->db->cache(86400)->createCommand()
                ->select("*")
                ->from("tbl_sizes")
                ->where(array("and", "type_id={$ct["id"]}", "group_id=1"))
                ->order("size ASC")
                ->queryAll();
            // получаем размеры малышей
            $cat["childs"][$ct["id"]] = $ct;
            $cat["childs"][$ct["id"]]["sizes"] = Yii::app()->db->cache(86400)->createCommand()
                ->select("*")
                ->from("tbl_sizes")
                ->where(array("and", "type_id={$ct["id"]}", "group_id=2"))
                ->order("size ASC")
                ->queryAll();
        }

        // формируем меню для девочек
        foreach($cat["girls"] as $key => $cg){
            $i = 0;
            $item = array();
            $cat["girls"][$key]["items"] = array();
            foreach($cg["sizes"] as $k => $s){
                $i++;
                if($k == 0){
                    $cat["girls"][$key]["items"][0]["value_from"] = $s["size"];
                    $i = 0;
                } else if($k == count($cg["sizes"])-1){
                    $cat["girls"][$key]["items"][count($cat["girls"][$key]["items"])-1]["value_to"] = $s["size"];
                }
                else {
                    if($i == $cg["step_girl"]) {
                        if(count($cat["girls"][$key]["items"])>0) {
                            if(!isset($cat["girls"][$key]["items"][count($cat["girls"][$key]["items"])-1]["value_to"])){
                                $cat["girls"][$key]["items"][count($cat["girls"][$key]["items"])-1]["value_to"] = $s["size"];
                                $i = $cg["step_girl"]-1;
                            }
                            else {
                                $cat["girls"][$key]["items"][count($cat["girls"][$key]["items"])]["value_from"] = $s["size"];
                                $i = 0;
                            }
                        }
                        else {
                            $cat["girls"][$key]["items"][0]["value_from"] = $s["size"];
                            $i = 0;
                        }
                    }
                }
            }
        }
        foreach($cat["girls"] as $key => $cg){
            foreach($cg["items"] as $k=>$v){
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
                               cat.id IS NOT NULL AND p.group='Девочка' AND c.value_from>={$v['value_from']} AND c.value_from<={$v['value_to']} AND c.value_to<={$v['value_to']}
                            ORDER BY
                               cat.name ASC";
                $cat["girls"][$key]["items"][$k]["items"] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
            }
        }

        // формируем меню для мальчиков
        foreach($cat["boys"] as $key => $cg){
            $i = 0;
            $item = array();
            $cat["boys"][$key]["items"] = array();
            foreach($cg["sizes"] as $k => $s){
                $i++;
                if($k == 0){
                    $cat["boys"][$key]["items"][0]["value_from"] = $s["size"];
                    $i = 0;
                } else if($k == count($cg["sizes"])-1){
                    $cat["boys"][$key]["items"][count($cat["boys"][$key]["items"])-1]["value_to"] = $s["size"];
                }
                else {
                    if($i == $cg["step_boy"]) {
                        if(count($cat["boys"][$key]["items"])>0) {
                            if(!isset($cat["boys"][$key]["items"][count($cat["boys"][$key]["items"])-1]["value_to"])){
                                $cat["boys"][$key]["items"][count($cat["boys"][$key]["items"])-1]["value_to"] = $s["size"];
                                $i = $cg["step_boy"]-1;
                            }
                            else {
                                $cat["boys"][$key]["items"][count($cat["boys"][$key]["items"])]["value_from"] = $s["size"];
                                $i = 0;
                            }
                        }
                        else {
                            $cat["boys"][$key]["items"][0]["value_from"] = $s["size"];
                            $i = 0;
                        }
                    }
                }
            }
        }
        foreach($cat["boys"] as $key => $cg){
            foreach($cg["items"] as $k=>$v){
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
                               cat.id IS NOT NULL AND p.group='Мальчик' AND c.value_from>={$v['value_from']} AND c.value_from<={$v['value_to']} AND c.value_to<={$v['value_to']}
                            ORDER BY
                               cat.name ASC";
                $cat["boys"][$key]["items"][$k]["items"] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
            }
        }

        // формируем меню для малышей
        foreach($cat["childs"] as $key => $cg){
            $i = 0;
            $item = array();
            $cat["childs"][$key]["items"] = array();
            foreach($cg["sizes"] as $k => $s){
                $i++;
                if($k == 0){
                    $cat["childs"][$key]["items"][0]["value_from"] = $s["size"];
                    $i = 0;
                } else if($k == count($cg["sizes"])-1){
                    $cat["childs"][$key]["items"][count($cat["childs"][$key]["items"])-1]["value_to"] = $s["size"];
                }
                else {
                    if($i == $cg["step_child"]) {
                        if(count($cat["childs"][$key]["items"])>0) {
                            if(!isset($cat["childs"][$key]["items"][count($cat["childs"][$key]["items"])-1]["value_to"])){
                                $cat["childs"][$key]["items"][count($cat["childs"][$key]["items"])-1]["value_to"] = $s["size"];
                                $i = $cg["step_child"]-1;
                            }
                            else {
                                $cat["childs"][$key]["items"][count($cat["childs"][$key]["items"])]["value_from"] = $s["size"];
                                $i = 0;
                            }
                        }
                        else {
                            $cat["childs"][$key]["items"][0]["value_from"] = $s["size"];
                            $i = 0;
                        }
                    }
                }
            }
        }
        foreach($cat["childs"] as $key => $cg){
            foreach($cg["items"] as $k=>$v){
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
                               cat.id IS NOT NULL AND p.group='Малыши' AND c.value_from>={$v['value_from']} AND c.value_from<={$v['value_to']} AND c.value_to<={$v['value_to']}
                            ORDER BY
                               cat.name ASC";
                $cat["childs"][$key]["items"][$k]["items"] = Yii::app()->db->cache(86400)->createCommand($query)->queryAll();
            }
        }

//        echo "<pre>";
//        print_r($cat["girls"]);
//        echo "</pre>";
//        exit;

/*        // Формируем верхнее меню
        // Формируем меню для девочек
        $query = "SELECT
                    DISTINCT(c.value_from)
                FROM
                    tbl_products as p
                LEFT JOIN
                    tbl_balances as b
                ON
                    p.code=b.product_code
                LEFT JOIN
                    tbl_characteristics as c
                ON
                    b.characteristic_code=c.code
                WHERE
                    p.`group`='Девочка' AND c.value_from>=86
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
                LEFT JOIN
                    tbl_balances as b
                ON
                    p.code=b.product_code
                LEFT JOIN
                    tbl_characteristics as c
                ON
                    b.characteristic_code=c.code
                WHERE
                    p.`group`='Мальчик' AND c.value_from>=86
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
                LEFT JOIN
                    tbl_balances as b
                ON
                    p.code=b.product_code
                LEFT JOIN
                    tbl_characteristics as c
                ON
                    b.characteristic_code=c.code
                WHERE
                    c.value_from<=86
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
*/

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
            $key1 = 0;
            $key2 = 0;
            foreach($cat["girls"] as $k1=>$cg){
                foreach($cg["items"] as $k2=>$i){
                    if(count($i["items"])>$count){
                        $key1 = $k1;
                        $key2 = $k2;
                        $count = count($i["items"]);
                    }
                }
            }
            $this->bottomMenu["girls"] = $cat["girls"][$key1]["items"][$key2]["items"];
        }
        if($cat["boys"]){
            $count = 0;
            $key1 = 0;
            $key2 = 0;
            foreach($cat["boys"] as $k1=>$cg){
                foreach($cg["items"] as $k2=>$i){
                    if(count($i["items"])>$count){
                        $key1 = $k1;
                        $key2 = $k2;
                        $count = count($i["items"]);
                    }
                }
            }
            $this->bottomMenu["boys"] = $cat["boys"][$key1]["items"][$key2]["items"];
        }
        if($cat["childs"]){
            $count = 0;
            $key1 = 0;
            $key2 = 0;
            foreach($cat["childs"] as $k1=>$cg){
                foreach($cg["items"] as $k2=>$i){
                    if(count($i["items"])>$count){
                        $key1 = $k1;
                        $key2 = $k2;
                        $count = count($i["items"]);
                    }
                }
            }
            $this->bottomMenu["childs"] = $cat["childs"][$key1]["items"][$key2]["items"];
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