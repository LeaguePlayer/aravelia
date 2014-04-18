<?php

class OrderController extends AdminController
{
    public function actionUpdate($id){
        $model = Order::model()->findByPk($id);

        if(!$model)
            throw new CHttpException(404, "Страница не найдена!");

        if($model->status==1){
            $model->status = 2;
            $model->update();
        }

        if(isset($_POST["Order"]))
        {
            $model->attributes = $_POST["Order"];
            if($model->status==1)
                $model->status = 2;
            $success = $model->update();
            if( $success ) {
                $this->redirect("/admin/order/list");
            }
        }
        $this->render("update", array('model' => $model));
    }
}
