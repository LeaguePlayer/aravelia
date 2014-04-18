<?php

/**
* This is the model class for table "{{sizes}}".
*
* The followings are the available columns in table '{{sizes}}':
    * @property integer $id
    * @property integer $size
    * @property string $desc
    * @property integer $type_id
    * @property integer $group_id
*/
class Size extends EActiveRecord
{
    public static $group = array("Девочка", "Мальчик", "Малыши");

    public static function getGroup($id = null){
        if($id != null)
            return self::$group[$id];
        return self::$group;
    }

    public function tableName()
    {
        return '{{sizes}}';
    }


    public function rules()
    {
        return array(
            array('size', 'required'),
            array('size, type_id, group_id', 'numerical', 'integerOnly'=>true),
            array('desc', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, size, desc, type_id, group_id', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'type'=>array(self::BELONGS_TO, "Categorytype", "type_id"),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'size' => 'Размер',
            'desc' => 'Описание',
            'type_id' => 'Тип категории',
            'group_id' => 'Группа',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('size',$this->size);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('group_id',$this->group_id);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition(){
        return "Размеры";
    }
}
