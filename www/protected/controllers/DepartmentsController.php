<?php

class DepartmentsController extends Controller
{
    public $active_page = 'organization';


    public function actionCreate($head = 0, $root = 0)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = new Department;
            $model->parent_id = $root;

            if (isset($_POST['Department'])) {
                $model->attributes = $_POST['Department'];
                $this->performAjaxValidation($model);
                $model->save();

                $head_job = new Job;
                $head_job->name = 'Руководитель';
                $head_job->user_id = $model->head_id;
                $head_job->head_type = 3;
                $head_job->save();

                $model->head_id = $head_job->id;
                $model->save();

                echo json_encode(array(
                    'success' => '1',
                    'errors' => array(),
                    'url' => $model->parent_id == 0 ? '/organization' : '',
                ));

                Yii::app()->end();
            }

            $this->render('_form', array('model' => $model, 'need_department_select' => $head != 1, 'default_root_id' => $root));
        }
    }


    public function actionEdit($id = 0, $head = 0)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = Department::model()->findByPk($id);

            if (isset($_POST['Department'])) {
                $model->attributes = $_POST['Department'];
                $this->performAjaxValidation($model);
                $model->save();

                echo json_encode(array(
                    'success' => '1',
                    'errors' => array(),
                    'url' => $model->parent_id == 0 ? '/organization' : '',
                ));

                Yii::app()->end();
            }

            $this->render('_form', array('model' => $model, 'need_department_select' => $head != 1, 'default_root_id' => $model->getRootDepartmentid()));
        }
    }


    public function actionDelete($id = 0)
    {
        $model = Department::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404);
        }
        $model->delete();
        $this->redirect('/organization');
    }


    public function actionSave_head()
    {
        if (!Yii::app()->request->isAjaxRequest) throw new CHttpException(404);

        $department_id = Yii::app()->request->getPost('department_id');
        $head_id = Yii::app()->request->getPost('head_id');

        $departament = Department::model()->findByPk($department_id);
        $user = User::model()->findByPk($head_id);

        if (!$departament) {
            throw new CHttpException(404);
        }

        $departament->head_id = $user ? $user->id : null;
        $departament->save();

        Yii::app()->end();
    }


    public function actionLoad($id)
    {
        if (!Yii::app()->request->isAjaxRequest) throw new CHttpException(404);
        $this->layout = 'none';

        $model = Department::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404);
        }

        Yii::app()->clientScript->scriptMap['jquery'] = false;
        Yii::app()->clientScript->scriptMap['activeform'] = false;

        $this->render('load', array('model' => $model));
    }
}
