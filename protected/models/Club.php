<?php

/**
* This is the model class for table "{{clubs}}".
*
* The followings are the available columns in table '{{clubs}}':
    * @property integer $id
    * @property string $name
    * @property string $email
    * @property string $phone
    * @property string $child_name
    * @property string $child_age
    * @property integer $status_user
    * @property integer $status
    * @property string $create_time
*/
class Club extends EActiveRecord
{
    public $status;

    public $invol;

    const INVOL_TRUE = 1;
    const INVOL_FALSE = 2;

    public function getInvolLabel($involId = null){
        $label = array(
            self::INVOL_TRUE => 'Да',
            self::INVOL_FALSE => 'Нет',
        );

        if($involId != null)
            return $label[$involId];
        return $label;
    }

    // Статусы в базе данных
    const STATUS_NEW = 1;
    const STATUS_VIEW = 2;
    const STATUS_DEFAULT = self::STATUS_NEW;

    public static function getStatusAliases($statusId = null)
    {
        $aliases = array(
            self::STATUS_NEW => 'Новый',
            self::STATUS_VIEW => 'Посмотрен',
        );

        if ($statusId != null)
            return $aliases[$statusId];

        return $aliases;
    }

    public function tableName()
    {
        return '{{clubs}}';
    }

    public function translition(){
        return "Заявки";
    }


    public function rules()
    {
        return array(
            array('name, email, phone, child_name, child_age, status_user, status, create_time', 'required'),
            array('status_user, status', 'numerical', 'integerOnly'=>true),
            array('name, email, child_name', 'length', 'max'=>255),
            array('phone', 'length', 'max'=>20),
            array('child_age', 'length', 'max'=>3),
            // The following rule is used by search().
            array('id, name, email, phone, child_name, child_age, status_user, status, create_time', 'safe', 'on'=>'search'),
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
            'email' => 'Email',
            'phone' => 'Телефон',
            'child_name' => 'Имя ребенка',
            'child_age' => 'Возраст ребенка',
            'status_user' => 'Участвовать в мероприятиях',
            'status' => 'Статус заявки',
            'create_time' => 'Дата',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('child_name',$this->child_name,true);
		$criteria->compare('child_age',$this->child_age,true);
		$criteria->compare('status_user',$this->status_user);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
