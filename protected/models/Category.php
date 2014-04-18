<?php

/**
* This is the model class for table "{{categories}}".
*
* The followings are the available columns in table '{{categories}}':
    * @property integer $id
    * @property string $code
    * @property string $name
    * @property string $create_time
    * @property string $update_time
*/
class Category extends EActiveRecord
{
    public function tableName()
    {
        return '{{categories}}';
    }


    public function rules()
    {
        return array(
            array('code, name', 'required'),
            array('code', 'length', 'max'=>20),
            array('name', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, code, name, type_id, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'type'=>array(self::BELONGS_TO, 'Categorytype', 'type_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'code' => 'Код в 1С',
            'name' => 'Название',
            'type_id' => 'Тип категории',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type_id',$this->type->id,true);
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

    public function translition(){
        return "Категории";
    }


}
