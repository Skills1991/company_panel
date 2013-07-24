<?php

function rec_drop($department, $level)
{
    $result[] = array('id' => $department->id, 'name' => str_repeat("---", $level) . $department->name);

    if ($department->children)
        foreach ($department->children as $child) {
            $result = array_merge($result, rec_drop($child, $level + 1));
        }

    return $result;
}

function rec_tree($department)
{
    $result = array('model' => $department, 'children' => array());

    foreach ($department->children as $child) {
        $result['children'][] = rec_tree($child);
    }

    return $result;
}


class Department extends CActiveRecord
{
    static $colors = array(
        '444',
        '555',
        '666',
        '777',
        '888',
        '999',
        '000',
        'aaa',
        'bbb',
        'ccc',
        'ddd'
    );

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'departments';
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('parent_id, functions, result, head_id', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'parent_id' => 'Родительский отдел',
            'name' => 'Имя департамента',
            'functions' => 'Функции',
            'result' => 'Результат',
            'head_id' => 'Руководитель',
        );
    }

    public function relations()
    {
        return array(
            'head_job' => array(self::BELONGS_TO, 'Job', 'head_id'),
            'children' => array(self::HAS_MANY, 'Department', 'parent_id'),
            'jobs' => array(self::HAS_MANY, 'Job', 'department_id'),
            'parent' => array(self::BELONGS_TO, 'Department', 'parent_id'),
        );
    }


    public function GetTree($model_id)
    {
        $model = Department::model()->findByPk($model_id);

        return rec_tree($model);
    }


    public function GetDropDownData($department_id = 0, $except_id = 0)
    {
        $department = Department::model()->findByPk($department_id);


        $result = array();
        foreach (rec_drop($department, 0) as $department) {
            $result[$department['id']] = $department['name'];
        }

        unset($result[$except_id]);

        return $result;
    }

    public function getRootDepartmentId()
    {
        $model = $this;
        while ($model->parent) $model = $model->parent;
        return $model->id;
    }

    public function afterDelete()
    {
        if ($this->head_job) {
            $this->head_job->delete();
        }

        foreach($this->children as $child){
            $child->delete();
        }
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->color = self::$colors[self::countByAttributes(array('parent_id' => 0)) % count(self::$colors)];
        }

        return true;
    }
}