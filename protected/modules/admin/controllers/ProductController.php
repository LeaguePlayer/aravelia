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

    public function actionUpdate($id){
        $model = Product::model()->findByPk($id);
        if(!$model)
            throw new CHttpException(404);

        if (isset($_POST['Product']['deletePhoto'])) {
            $behaviorName = 'imgBehavior'.ucfirst( $_POST['Product']['deletePhoto'] );
            $model->{$behaviorName}->deletePhoto();
            if ( Yii::app()->request->isAjaxRequest ) {
                Yii::app()->end();
            }
        }

        if(isset($_POST['Product']))
        {
            $model->attributes = $_POST['Product'];
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/product/update/id/'.$id);
            }
        }
        $this->render('update',array('model' => $model));
    }
}
