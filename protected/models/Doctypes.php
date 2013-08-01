<?php

/**
 * This is the model class for table "doctypes".
 *
 * The followings are the available columns in table 'doctypes':
 * @property integer $id
 * @property string $name
 */
class Doctypes extends CActiveRecord
{
    public static function getTypes()
    {
        $types = self::model()->findAll();

        foreach($types as $type)
            echo "<input type='checkbox' class='types' name='types[]' value='".$type->id."'><strong>".$type->name."</strong><br />";
            /*if (!empty($_GET['heading']))
                echo CHtml::link($type->name,array('documents/index','heading'=>(int)$_GET['heading'],'type'=>$type->id))."<br />";
            else
                echo CHtml::link($type->name,array('documents/index','type'=>$type->id))."<br />";*/
    }

    public static function getTypesArray()
    {
        $arr = array();
        $type = self::model()->findAll();

        foreach($type as $type)
            $arr[$type->id] = $type->name;
        return $arr;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Doctypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'doctypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}