<?php

class favoriteWidget extends CWidget {
    public function run() {

        $data["favorites"] = null;
        if(json_decode(Yii::app()->request->cookies['favorites'])){
            $data["favorites"] = json_decode(Yii::app()->request->cookies['favorites']);

            foreach($data["favorites"] as $f){
                $favorite[] = $f->id;
            }

            $data["favorites"] = Yii::app()->db->createCommand()
                ->select("id,name,gllr_photos")
                ->from("tbl_products")
                ->where(array("in", "id", $favorite))
                ->queryAll();
        }

        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile(Yii::app()->controller->getAssetsUrl().'/js/min/favorites_carousel.min.js', CClientScript::POS_END);

        $this->render("index", $data);
    }
}