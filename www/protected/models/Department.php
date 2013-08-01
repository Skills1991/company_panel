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

    public static function render_level_list($items ,$level = 0)
    {
        $count = 1;
        foreach($items as $item)
        {
        for ($i=0;$i<$level;$i++)
            echo "&nbsp;&nbsp;&nbsp;";
        if ($item->parent_id == 0)
            echo "<input type='checkbox' class='departments' name='departments[]' value='".$item->id."'><strong>".$count.". ".$item->name."</strong><br />";
        else
            echo "<input type='checkbox' class='departments' name='departments[]' value='".$item->id."'>".$count.". ".$item->name."<br />";
        $count++;
        $items = Department::model()->findAllByAttributes(array('parent_id'=>$item->id));
        if ($items!=NULL)
            self::render_level_list($items,$level+1);

        }
    }

    public static function render_level_list_array($items = NULL )
    {
        $arr = array();
        if ($items == NULL)
            $items = Department::model()->findAll();
        foreach($items as $item)
        {
            $arr[$item->id]=$item->name;

        }

        return $arr;
    }

}