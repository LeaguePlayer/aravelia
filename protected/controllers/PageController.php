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

	
	public function actionView($url)
	{
        $data = array();

        $node = Structure::model()->findByUrl($url);
        if($node)
            $data["model"] = $node->getComponent();
        else
            throw new CHttpException(404);

        if($node->id==3){
            $this->layout = "//layouts/landing";
        }

        $this->title = $node->name;

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
