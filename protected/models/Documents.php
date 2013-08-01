<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property integer $id
 * @property string $name
 * @property integer $headling_id
 * @property integer $type_id
 * @property string $date
 * @property integer $user_id
 * @property string $dostup
 * @property string $link
 */
class Documents extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
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
		return 'documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type_id, dostup, comment', 'required'),
			array('link', 'file', 'allowEmpty'=>true, 'types'=>'doc, docx, pdf, djvu, xls, xlsx, ppt, pptx', 'on'=>'update' ),
			array('link', 'file', 'allowEmpty'=>false, 'types'=>'doc, docx, pdf, djvu, xls, xlsx, ppt, pptx', 'on'=>'create'  ),
			array('heading_id, type_id, user_id, family', 'numerical', 'integerOnly'=>true),
			array('name, date', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, heading_id, type_id, date, user_id, dostup, link, family, comment', 'safe', 'on'=>'search'),
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
            'headling' => array(self::BELONGS_TO, 'Docheadings','heading_id'),
            'type' => array(self::BELONGS_TO, 'Doctypes','type_id'),
            'user' => array(self::BELONGS_TO, 'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя документа',
			'heading_id' => 'Рубрика',
			'type_id' => 'Тип',
			'date' => 'Дата',
			'user_id' => 'Автор',
			'dostup' => 'Доступ',
			'link' => 'Файл',
			'comment' => 'Комментарий',
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
		$criteria->compare('headling_id',$this->headling_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('dostup',$this->dostup,true);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function hasDepartment($id)
    {
        $departments = explode(';', $this->dostup);
        if (in_array($id,$departments))
            return true;
        else
            return false;
    }
}