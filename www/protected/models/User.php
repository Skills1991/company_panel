<?php

class User extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return array(
            array('login, password, email', 'required'),
            array('last_visit, phone, register_date, father_name, name, surname', 'safe'),
            array('register_date', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert')
        );
    }

    public function relations()
    {
        return array(
            'jobs' => array(self::HAS_MANY, 'Job', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Логин',
            'email' => 'E-mail',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'father_name' => 'Отчество',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'last_login' => 'Дата последнего входа',
            'register_date' => 'Дата регистрации'
        );
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }


    public function validatePassword($password)
    {
        return $this->password == $password;
    }

    public static function GetCEO()
    {
        $job = Job::GetCEO();

        $user = UserJob::FindUsers($job->id, true);

        return $user;
    }

    public static function GetHeads()
    {
        $jobs = Job::GetHeads();

        $result = array();
        foreach ($jobs as $job) {
            $result[] = array(
                'job' => $job,
                'user' => UserJob::FindUsers($job->id, true)
            );
        }

        return $result;
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    public static function GetAll()
    {
        $result = array();

        foreach (self::model()->findAll() as $user) {
            $result[$user->id] = (string)$user;
        }

        return $result;
    }
}