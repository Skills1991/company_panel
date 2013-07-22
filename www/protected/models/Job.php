<?php

class Job extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'jobs';
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('functions,head_type, result, department_id, user_id', 'safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Название',
            'functions' => 'Функции',
            'result' => 'Результат',
            'department_id' => 'Подразделение',
            'user_id' => 'Сотрудник',
        );
    }

    public function relations()
    {
        return array(
            'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public static function GetCEO()
    {
        $result = self::model()->findByAttributes(array('head_type' => 2));
        if (!$result) {
            $result = new self();
            $result->name = 'Генеральный директор';
            $result->head_type = 2;
            $result->save();
        }
        return $result;
    }

    public static function GetHeads()
    {
        return self::model()->findAllByAttributes(array(
            'head_type' => 1
        ));
    }

    public function afterDelete()
    {
        UserJob::model()->deleteAllByAttributes(array('job_id' => $this->id));
    }

    public function afterFind(){
        $this->departments_head = empty($this->departments_head) ? array() : json_decode($this->departments_head);
    }

    public function beforeSave(){
        $this->departments_head = json_encode(is_array($this->departments_head) ? $this->departments_head : array());

        return true;
    }

}