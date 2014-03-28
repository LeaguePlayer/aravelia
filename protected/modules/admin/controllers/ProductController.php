<?php

class ProductController extends AdminController
{
    public function actionList(){
        $model = new Product("search");

        $model->searchCat = new Category("search");

        $model->searchBrand = new Brand("search");

        $model->unsetAttributes();
        $model->searchCat->unsetAttributes();
        $model->searchBrand->unsetAttributes();

        if(isset($_GET["Product"]))
            $model->attributes = $_GET["Product"];

        if(isset($_GET["Category"]))
            $model->searchCat->attributes = $_GET["Category"];

        if(isset($_GET["Brand"]))
            $model->searchBrand->attributes = $_GET["Brand"];

        $this->render("list", array(
            'model' => $model,
        ));
    }
}
