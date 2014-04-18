<?php

class CategoryController extends AdminController
{
	public function actionUpdate($id){
        $model = Category::model()->findByPk($id);

        if(isset($_POST["Category"]))
        {
            $model->attributes = $_POST["Category"];
            $model->type_id = $_POST["Category"]["type_id"];
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/category');
            }
        }
        $this->render('update',array('model' => $model));
    }
}
