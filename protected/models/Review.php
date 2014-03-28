<?php

/**
* This is the model class for table "{{reviews}}".
*
* The followings are the available columns in table '{{reviews}}':
    * @property integer $id
    * @property string $name
    * @property integer $age
    * @property string $text
    * @property integer $status
    * @property string $create_time
    * @property string $update_time
*/
class Review extends EActiveRecord
{
    public function tableName()
    {
        return '{{reviews}}';
    }

    public function defaultScope(){
        return array(
            "order"=>"create_time DESC",
        );
    }

    public function translition() {
        return "Отзывы";
    }

    public function __get($name){
        if($name == "ageLabel")
            return $this->getAgeLabel();
        return parent::__get($name);
    }

    public function rules()
    {
        return array(
            array('name, age, text, status, create_time, update_time', 'required'),
            array('age, status', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, age, text, status, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Имя',
            'age' => 'Возраст',
            'text' => 'Отзыв',
            'status' => 'Статус',
            'create_time' => 'Дата создания',
            'update_time' => 'Update Time',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function beforeValidate(){
        parent::beforeValidate();
        if($this->isNewRecord)
            $this->create_time = date("Y-m-d H:i:s");
        $this->update_time = date("Y-m-d H:i:s");

        return true;
    }

    public function getAgeLabel(){
        $age = $this->age;
        if($age == "1" || ($age{strlen($age)-1} == "1" && $age{0} > 1))
            return "год";
        if(($age > 1 && $age < 5) || ($age{strlen($age)-1} > 1 && $age{strlen($age)-1} < 5))
            return "года";
        if(($age >= 5 && $age <= 20) || ($age{0}>1 && $age{strlen($age)-1} > 4) || (($age{0}>1 && $age{strlen($age)-1} == 0)))
            return "лет";
        return null;
    }

}
