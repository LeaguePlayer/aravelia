<?php

class PageController extends AdminController
{
    public function actionCreate()
    {
        $model = new Page();

        if($model->isNewRecord || empty($model->wswg_body)){
            $model->wswg_body = '<section class="content width">
<h1>Заголовок</h1>

<div class="page">
Текст страницы текст страницы текст страницы текст страницы текст страницы текст страницы.
</div>
</section>';
        }

        if(isset($_POST['Page']))
        {
            $model->attributes = $_POST['Page'];
            $success = $model->save();
            if( $success ) {
                $message = 'Страница успешно сохранена.';
                Yii::app()->user->setFlash('PAGE_SAVED', $message);
                $this->redirect(array('update', 'id' => $model->id));
            }
        }
        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('Page', $id);

        if(empty($model->wswg_body)){
            $model->wswg_body = '<section class="content width">
<h1>Заголовок</h1>

<div class="page shadow">
<p>Текст страницы текст страницы текст страницы текст страницы текст страницы текст страницы.</p>
</div>
</section>';
        }

        if(isset($_POST['Page']))
        {
            $model->attributes = $_POST['Page'];
            $success = $model->save();
            if( $success ) {
                $this->redirect(array('/admin/structure/list'));
            }
        }
//        Yii::import('appext.imagesmultigallery.GalleryManager');
//        GalleryManager::registerScripts();
        $this->render('update', array('model' => $model));
    }
}
