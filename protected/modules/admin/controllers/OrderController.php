<?php

class OrderController extends AdminController
{
    public function actionUpdate($id){
        $model = Order::model()->findByPk($id);

        if(!$model)
            throw new CHttpException(404, "Страница не найдена!");

        if(isset($_POST["Order"]))
        {
            $model->attributes = $_POST["Order"];
            $success = $model->update();
            if( $success ) {
                $this->redirect("/admin/order/list");
            }
        }
        $this->render("update", array('model' => $model));
    }
}
