<?php

class PageController extends FrontController
{
	public $layout='//layouts/main';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionLanding(){
        $this->layout = "//layouts/landing";

        $node = Structure::model()->findByUrl("landing");
        if($node)
            $data["model"] = $node->getComponent();
        else
            throw new CHttpException(404);

        if ( !empty($node->seo->meta_title) )
            $this->title = $node->seo->meta_title.' | '.Yii::app()->config->get('app.name');
        else
            $this->title = $node->name . ' | ' . Yii::app()->config->get('app.name');

        $this->render('landing', $data);
    }

	
	public function actionView($url)
	{
        $data = array();

        $node = Structure::model()->findByUrl($url);
        if($node)
            $data["model"] = $node->getComponent();
        else
            throw new CHttpException(404);

        if ( !empty($node->seo->meta_title) )
            $this->title = $node->seo->meta_title.' | '.Yii::app()->config->get('app.name');
        else
            $this->title = $node->name . ' | ' . Yii::app()->config->get('app.name');

        if($node->id==3){
            $this->layout = "//layouts/landing";

            $today = date("Y-m-d H:i:s");

            $data["action"] = Action::model()->find(array(
                "condition"=>"dt_date > :today",
                "order"=>"dt_date ASC",
                "params"=>array(
                    ":today"=>$today,
                ),
            ));

            $data["oldAction"] = Action::model()->find(array(
                "condition"=>"dt_date < :today",
                "order"=>"dt_date DESC",
                "params"=>array(
                    ":today"=>$today,
                ),
            ));
            $data["oldActionGallery"] = $data["oldAction"]->photoGallery->galleryPhotos;

            $data["concursGallery"] = $data["action"]->concursGallery->galleryPhotos;

            $data["oldActionAll"] = Action::model()->findAll(array(
                "condition"=>"dt_date < :today",
                "order"=>"dt_date DESC",
                "params"=>array(
                    ":today"=>$today,
                ),
            ));

            $this->render("landing", $data);
            return true;
        }

		$this->render('view', $data);
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Page');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
