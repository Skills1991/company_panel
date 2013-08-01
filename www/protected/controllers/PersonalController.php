<?php

class PersonalController extends Controller
{
    public $active_page = 'personal';

    public function actionIndex()
    {
        $this->render('index');
    }


    public function actionCreate()
    {
        $model = new User;

        if (Yii::app()->request->isPostRequest) {
            if ($_POST['User']) {
                $model->attributes = $_POST['User'];
                if ($model->save()) {
                    $this->redirect('/personal/');
                }
            }
        }

        $this->render('create', array('model' => $model));
    }


    public function actionEdit($id)
    {
        $model = User::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404);
        }

        if (Yii::app()->request->isPostRequest) {
            if ($_POST['User']) {
                $model->attributes = $_POST['User'];
                if ($model->save()) {
                    $this->redirect('/personal');
                }
            }
        }

        $this->render('edit', array('model' => $model));
    }


    public function actionLoad_popover($id = 0)
    {
        if(!Yii::app()->request->isAjaxRequest){
            throw new CHttpException(404);
        }

        $model = User::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404);
        }

        $this->render('_popover', array('model' => $model));
    }

}