<?php

class seeProducts extends CWidget {
    public function run(){

        if(unserialize(Yii::app()->request->cookies['see_products'])){
            $data["products"] = unserialize(Yii::app()->request->cookies['see_products']);

            if(isset($data["products"][$_GET["id"]]))
                unset($data["products"][$_GET["id"]]);

            $data["products"] = array_keys($data["products"]);
            $data["products"] = Yii::app()->db->createCommand()
                ->select("id,name,gllr_photos")
                ->from("tbl_products")
                ->where(array("in", "id", $data["products"]))
                ->queryAll();
        }
        else {
            $data["products"] = null;
        }

        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile(Yii::app()->controller->getAssetsUrl().'/js/jcarousellite.js', CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->controller->getAssetsUrl().'/js/min/viewed_carousel.min.js', CClientScript::POS_END);

        $this->render("index", $data);
    }
}