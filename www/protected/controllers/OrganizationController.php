<?php

class OrganizationController extends Controller
{
    public $active_page = 'organization';

    public function actionIndex()
    {
        $this->render('index');
    }

    // AJAX на сохранение гендира
    public function actionSave_ceo()
    {
        if (Yii::app()->request->isAjaxRequest == false) throw new CHttpException(404);

        $person_id = Yii::app()->request->getPost('person');
        $job_name = Yii::app()->request->getPost('job');

        $ceo_job = Job::GetCEO();
        $ceo_job->name = $job_name;
        $ceo_job->save();

        $last_ceo = User::GetCEO();

        $ceo_user_job = UserJob::model()->findByAttributes(array('job_id' => $ceo_job->id));
        if (!$ceo_user_job) {
            $ceo_user_job = new UserJob;
            $ceo_user_job->job_id = $ceo_job->id;
        }
        $ceo_user_job->user_id = $person_id;
        $ceo_user_job->save();


        Yii::app()->end();
    }

    // AJAX на сохранение/добавление директора
    public function actionSave_head()
    {
        if (Yii::app()->request->isAjaxRequest == false) throw new CHttpException(404);

        $job_id = Yii::app()->request->getPost('job_id');
        $person_id = Yii::app()->request->getPost('person_id');
        $job_name = Yii::app()->request->getPost('job_name');

        $job = empty($job_id) ? new Job : Job::model()->findByPk($job_id);
        if (!$job) {
            throw new CHttpException(404);
        }

        $person = User::model()->findByPk(1);
        if (!$person) {
            throw new CHttpException(404);
        }

        $job->head_type = 1;
        $job->name = $job_name;
        $job->save();

        $user_job = UserJob::model()->findByAttributes(array('job_id' => $job->id));
        if (!$user_job) {
            $user_job = new UserJob;
            $user_job->job_id = $job->id;
        }

        $user_job->user_id = $person_id;
        $user_job->save();

        Yii::app()->end();
    }

    // AJAX на удаление директора
    public function actionDelete_head($id = 0)
    {
        if (Yii::app()->request->isAjaxRequest == false) throw new CHttpException(404);

        $job = Job::model()->findByPk($id);
        if (!$job || $job->head_type != 1) {
            throw new CHttpException(404);
        }

        $job->delete();
        Yii::app()->end();
    }

}