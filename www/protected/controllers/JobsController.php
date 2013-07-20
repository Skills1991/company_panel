<?php

class JobsController extends Controller
{
    public $active_page = 'organization';


    public function actionCreate($head = 0, $root = 0)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = new Job;

            $model->department_id = $root;

            $model->head_type = $head;
            if (isset($_POST['Job'])) {
                $model->attributes = $_POST['Job'];
                $this->performAjaxValidation($model);
                $model->save();

                echo json_encode(array(
                    'success' => '1',
                    'errors' => array(),
                    'url' => $model->head_type == 0 ? '' : '/organization',
                ));

                Yii::app()->end();
            }

            $this->render('_form', array('model' => $model));
        }
    }


    public function actionEdit($id = 0, $head = 0)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = Job::model()->findByPk($id);

            if (isset($_POST['Job'])) {
                $model->attributes = $_POST['Job'];
                $this->performAjaxValidation($model);
                $model->save();

                echo json_encode(array(
                    'success' => '1',
                    'errors' => array(),
                    'url' => $model->head_type == 0 ? '' : '/organization',
                ));

                Yii::app()->end();
            }

            $this->render('_form', array('model' => $model));
        }
    }

    public function actionDelete($id = 0)
    {
        $model = Job::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404);
        }
        $model->delete();
        $this->redirect('/organization');
    }

}
