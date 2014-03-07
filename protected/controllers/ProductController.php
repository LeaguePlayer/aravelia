<?php

class ProductController extends FrontController
{
    public $layout = "//layouts/main";

	public function actionIndex($id)
	{
        if(!is_numeric($id))
            throw new CHttpException(400, "Неверные параметры запроса");

        $data["model"] = Product::model()->findByPk($id);

        if(!$data["model"])
            throw new CHttpException(404, "Страница не найдена");

        $data["sizes"] = Yii::app()->db->createCommand()
            ->select("b.id,b.price,b.count,c.value,c.value_from")
            ->from("tbl_balances as b")
            ->leftJoin("tbl_characteristics as c", "b.characteristic_code=c.code")
            ->where("b.product_code='{$data["model"]->code}'")
            ->order("c.value_from ASC")
            ->queryAll();

        $data["photos"] = $data["model"]->getGalleryPhotos();

        $cs = Yii::app()->clientScript;
        $cs->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css');
        $cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.fancybox.js', CClientScript::POS_END);
        $cs->registerScriptFile($this->getAssetsUrl().'/js/min/product.min.js', CClientScript::POS_END);

        if(Yii::app()->request->cookies['see_products'])
            $see = unserialize(Yii::app()->request->cookies['see_products']);

        $see[$id] = true;
        Yii::app()->request->cookies['see_products'] = new CHttpCookie('see_products', serialize($see));

		$this->render('index', $data);
	}
}