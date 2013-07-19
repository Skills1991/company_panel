<?php

class Controller extends CController
{
    public $layout = '//layouts/main';

    public $menu = array();

    public $breadcrumbs = array();


    public $active_page = '';


    protected function performAjaxValidation($model)
    {
        $validate = json_decode(CActiveForm::validate($model));

        if (empty($validate)) {
            return true;
        } else {
            echo json_encode(array(
                'success' => 0,
                'errors' => $validate
            ));

            Yii::app()->end();

            return false;
        }
    }

    public function beforeAction($action)
    {
        if (Yii::app()->user->isGuest && $action->id != 'login') {
            $this->redirect('/auth/login');
        }

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.yiiactiveform.js'] = false;

            $this->layout = 'none';
        }

        return parent::beforeAction($action);
    }

}