<?php

class UserJob extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_jobs';
    }

    public function rules()
    {
        return array(
            array('user_id, job_id', 'required'),
        );
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'job' => array(self::BELONGS_TO, 'Job', 'job_id')
        );
    }

    public static function FindUsers($job_id, $one = false)
    {
        $result = array();

        $user_jobs = self::model()->findAllByAttributes(array('job_id' => $job_id));

        foreach ($user_jobs as $user_job) {
            $result[] = $user_job->user;
        }

        if ($one) {
            return empty($result) ? null : $result[0];
        }

        return $result;
    }
}