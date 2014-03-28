<?php

/**
* This is the model class for table "{{order_certificates}}".
*
* The followings are the available columns in table '{{order_certificates}}':
    * @property integer $id
    * @property integer $order_id
    * @property integer $certificate_id
    * @property integer $count
    * @property double $price
*/
class OrderCertificate extends EActiveRecord
{
    public function tableName()
    {
        return '{{order_certificates}}';
    }


    public function rules()
    {
        return array(
            array('order_id, certificate_id, count, price', 'required'),
            array('order_id, certificate_id, count', 'numerical', 'integerOnly'=>true),
            array('price', 'numerical'),
            // The following rule is used by search().
            array('id, order_id, certificate_id, count, price', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            "certificate"=>array(self::BELONGS_TO, 'Certificate', 'certificate_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'order_id' => 'Связь с таблицей orders',
            'certificate_id' => 'Связь с таблицей certificates',
            'count' => 'Количество заказанного товара',
            'price' => 'Цена за единицу товара',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('certificate_id',$this->certificate_id);
		$criteria->compare('count',$this->count);
		$criteria->compare('price',$this->price);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
