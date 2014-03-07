<?php

class CatalogController extends FrontController
{
    public $layout = "//layouts/main";

	public function actionIndex()
	{
        $criteria = array();
        $get = array();
        $redirect = false;

        if(isset($_GET["group"])){
            $criteria[] = "p.`group`='".mb_ereg_replace("/[^А-Яа-я]/", "", $_GET["group"])."'";
            $get[] = "group=".mb_ereg_replace("/[^А-Яа-я]/", "", $_GET["group"]);
            if(strlen($_GET["group"]) != strlen(mb_ereg_replace("/[^А-Яа-я]/", "", $_GET["group"])))
                $redirect = true;
        }
        else {
            $criteria[] = "p.`group`='Девочка'";
            $get[] = "group=Девочка";
            $redirect=true;
        }

        if(isset($_GET["char"])){
            $char = explode("-", $_GET["char"]);
            if(strlen(preg_replace("/[^0-9]/", "", $char[0]))>0){
                $criteria[] = "c.value_from>=".preg_replace("/[^0-9]/", "", $char[0]);
                if(count($char) > 1){
                    $criteria[] = "c.value_from<".preg_replace("/[^0-9]/", "", $char[1]);
                    $criteria[] = "c.value_to<".preg_replace("/[^0-9]/", "", $char[1]);
                    $get[] = "char=".preg_replace("/[^0-9]/", "", $char[0])."-".preg_replace("/[^0-9]/", "", $char[1]);
                    if(strlen($_GET["char"]) != strlen(preg_replace("/[^0-9]/", "", $char[0])."-".preg_replace("/[^0-9]/", "", $char[1])))
                        $redirect = true;
                }
                else {
                    $get[] = "char=".preg_replace("/[^0-9]/", "", $char[0]);
                    if(strlen($_GET["char"]) != strlen(preg_replace("/[^0-9]/", "", $char[0])))
                        $redirect = true;
                }
            }
        }

        if(isset($_GET["cat"])){
            if(is_numeric($_GET["cat"])){
                $criteria[] = "cat.id=".preg_replace("/[^0-9]/", "", $_GET["cat"]);
                $get[] = "cat=".preg_replace("/[^0-9]/", "", $_GET["cat"]);
                if(strlen($_GET["cat"]) != strlen(preg_replace("/[^0-9]/", "", $_GET["cat"])))
                    $redirect = true;
            }
        }

        if(isset($_GET["brand"])){
            $criteria[] = "p.brand_code=".preg_replace("/[^0-9]/", "", $_GET["brand"]);
            $get[] = "brand=".preg_replace("/[^0-9]/", "", $_GET["brand"]);
            if(strlen($_GET["brand"]) != strlen(preg_replace("/[^0-9]/", "", $_GET["brand"])))
                $redirect = true;
        }

        if(isset($_GET["page"])){
            if(is_numeric($_GET["page"]) && $_GET["page"]>0){
                $limit = ($_GET["page"]-1)*16;
                $get[] = "page=".$_GET["page"];
            }
            else {
                $limit = "0";
                $get[] = "page=1";
            }
        }
        else {
            $limit = "0";
            $get[] = "page=1";
        }

        if($redirect)
            $this->redirect("/catalog?".implode("&",$get));

        // определяем общее количество записей для пагинации
        $query = "SELECT
                    count(p.id) count
                FROM
                    tbl_products as p
                RIGHT JOIN
                    (SELECT
                        tbl_balances.product_code,
                        tbl_balances.characteristic_code
                    FROM
                        tbl_balances
                    WHERE
                        tbl_balances.count>0
                    GROUP BY
                        tbl_balances.product_code) as b
                ON
                    p.code=b.product_code
                LEFT JOIN
                    tbl_characteristics as c
                ON
                    b.characteristic_code=c.code
                LEFT JOIN
                    tbl_categories as cat
                ON
                    cat.code=p.category_code
                WHERE
                    ".implode(" AND ", $criteria);
        $count = Yii::app()->db->createCommand($query)->queryRow();
        $data["pages"] = new CPagination($count["count"]);
        $data["pages"]->pageSize = 16;
        $data["pages"]->pageVar = "page";

        $query = "SELECT
                    p.id,
                    p.name,
                    gllr_photos
                FROM
                    tbl_products as p
                RIGHT JOIN
                    (SELECT
                        tbl_balances.product_code,
                        tbl_balances.characteristic_code
                    FROM
                        tbl_balances
                    WHERE
                        tbl_balances.count>0
                    GROUP BY
                        tbl_balances.product_code) as b
                ON
                    p.code=b.product_code
                LEFT JOIN
                    tbl_characteristics as c
                ON
                    b.characteristic_code=c.code
                LEFT JOIN
                    tbl_categories as cat
                ON
                    cat.code=p.category_code
                WHERE
                    ".implode(" AND ", $criteria)."
                LIMIT
                    ".$limit.",16";

        $data["products"] = Yii::app()->db->createCommand($query)->queryAll();

        $data["brands"] = Yii::app()->db->createCommand()
            ->select("id, code, name")
            ->from("tbl_brands")
            ->order("name ASC")
            ->queryAll();

        $data["groups"] = Yii::app()->db->createCommand()
            ->select("distinct(`group`)")
            ->from("tbl_products")
            ->queryAll();

        $key = array_search("cat.id=".$_GET["cat"], $criteria);
        if ($key !== false)
            unset($criteria[$key]);
        $data["categories"] = Yii::app()->db->createCommand("SELECT
                                                                distinct(id),
                                                                name
                                                            FROM
                                                                (SELECT
                                                                    cat.id,
                                                                    cat.name
                                                                FROM
                                                                    tbl_categories as cat
                                                                RIGHT JOIN
                                                                    tbl_products as p
                                                                ON
                                                                    p.category_code=cat.code
                                                                RIGHT JOIN
                                                                    tbl_balances as b
                                                                ON
                                                                    b.product_code=p.code
                                                                RIGHT JOIN
                                                                    tbl_characteristics as c
                                                                ON
                                                                    c.code=b.characteristic_code
                                                                WHERE
                                                                    ".implode(" AND ", $criteria)."
                                                                ORDER BY
                                                                    cat.name ASC) as tbl")->queryAll();

        // передаем GET параметры во вьюху
        $data["get"] = $get;

        // формируем текст


        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile($this->getAssetsUrl().'/js/min/filter.min.js', CClientScript::POS_END);

		$this->render('index', $data);
	}
}