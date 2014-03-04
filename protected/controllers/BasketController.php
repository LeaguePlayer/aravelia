<?php

class BasketController extends FrontController
{
    public $layout = "//layouts/main";

	public function actionIndex()
	{
        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile($this->getAssetsUrl().'/js/min/basket.min.js', CClientScript::POS_END);

		$this->render('index');
	}
}