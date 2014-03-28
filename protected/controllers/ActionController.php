<?php

class ActionController extends FrontController
{
    public $layout = "//layouts/landing";

    public function actionIndex($id){

        $data["model"] = $this->loadModel($id);

        $today = date("Y-m-d H:i:s");

        $data["oldActionAll"] = Action::model()->findAll(array(
            "condition"=>"dt_date < :today",
            "order"=>"dt_date DESC",
            "params"=>array(
                ":today"=>$today,
            ),
        ));
        $data["concursGallery"] = $data["model"]->concursGallery->galleryPhotos;
        $data["photoGallery"] = $data["model"]->photoGallery->galleryPhotos;

        $this->render("index", $data);
    }

    public function loadModel($id){
        $model = Action::model()->findByPk($id);
        if(model)
            return $model;
        else
            throw new CHttpException(404);
    }
}