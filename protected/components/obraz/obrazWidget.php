<?php

class obrazWidget extends CWidget {
    public function run() {
        $id = null;
        $products = null;

        if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $id = $_GET["id"];
            $category = Yii::app()->db->createCommand()
                ->select("category_code")
                ->from("tbl_products")
                ->where("id=:id", array(":id"=>$id))
                ->queryRow();
            $category = $category["category_code"];

            $count = Yii::app()->db->createCommand()
                ->select("count(id) as count")
                ->from("tbl_products")
                ->where("category_code=:cat", array(":cat"=>$category))
                ->queryAll();

            $count = $count[0]["count"];
            $count = rand(0, $count-4);

            $data["products"] = Yii::app()->db->createCommand()
                ->select("id, name, gllr_photos")
                ->from("tbl_products")
                ->where(array("and","category_code=:cat","id!=:id"), array(":cat"=>$category,":id"=>$id))
                ->limit(3,$count)
                ->queryAll();
        }

        $this->render("index", $data);
    }
}