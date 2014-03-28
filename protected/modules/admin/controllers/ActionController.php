<?php

class ActionController extends AdminController
{
	public function actionUpdate($id){
        $model = Action::model()->findByPk($id);

        if (isset($_POST["Action"]['deletePhoto'])) {
            $behaviorName = 'imgBehavior'.ucfirst( $_POST["Action"]['deletePhoto'] );
            $model->img_photo = null;
            $model->{$behaviorName}->deletePhoto();
            if ( Yii::app()->request->isAjaxRequest ) {
                Yii::app()->end();
            }
        }

        if(isset($_POST["Action"]))
        {
            $model->attributes = $_POST["Action"];
            $success = $model->save();
            if( $success ) {
                $this->redirect("/admin/action/list");
            }
        }
        $this->render("update", array('model' => $model));
    }
}
