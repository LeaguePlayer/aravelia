<?php

class BasketController extends FrontController
{
    public $layout = "//layouts/main";

	public function actionIndex()
	{
        $products = json_decode(Yii::app()->request->cookies['products']);
        $p_ids = array();
        $b_ids = array();

        if(Yii::app()->request->isAjaxRequest) {
            $this->layout = "//layouts/clear";
            Yii::app()->clientScript->scriptMap["jquery.js"] = false;
            $favorites = json_decode(Yii::app()->request->cookies['favorites']);
            if(isset($favorites) && $favorites != null){
                foreach($favorites as $f){
                    if(is_numeric($f->id))
                        $fav[] = $f->id;
                }
                $query = "SELECT
                            p.id pid,
                            b.id bid
                        FROM
                            tbl_products as p
                        LEFT JOIN
                            (SELECT
                                *
                                FROM
                                tbl_balances
                            GROUP BY
                                product_code) as b
                        ON
                            p.code=b.product_code
                        WHERE
                            p.id IN (".implode(',', $fav).")";
                $result = Yii::app()->db->createCommand($query)->queryAll();
                if($result){
                    foreach($result as $r){
                        $p_ids[] = $r["pid"];
                        $b_ids[] = $r["bid"];
                    }
                }
            }
        }

        if(isset($products) && $products != null){
            foreach($products as $p){
                $p_ids[] = $p->id;
                $b_ids[] = $p->balans_id;
            }
        }
        else {
            $data["products"] = null;
        }

        if(count($p_ids)>0 && count($b_ids)>0){
            $data["products"] = Yii::app()->db->createCommand()
                ->select("p.id, p.code, p.name, p.country, p.group, p.gllr_photos, b.id bid, b.price, b.count, c.value")
                ->from("tbl_products as p")
                ->rightJoin("tbl_balances as b", "p.code=b.product_code")
                ->leftJoin("tbl_characteristics as c", "b.characteristic_code=c.code")
                ->where(array("and", array("in", "p.id", $p_ids), array("in", "b.id", $b_ids)))
                ->queryAll();
        }

        if(!Yii::app()->request->isAjaxRequest){
            $cs = Yii::app()->clientScript;
            $cs->registerScriptFile($this->getAssetsUrl().'/js/min/basket.min.js', CClientScript::POS_END);
        }

		$this->render('index', $data);
	}
}