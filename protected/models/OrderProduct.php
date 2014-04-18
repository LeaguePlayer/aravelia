<?php

/**
* This is the model class for table "{{order_products}}".
*
* The followings are the available columns in table '{{order_products}}':
    * @property integer $id
    * @property integer $product_id
    * @property integer $order_id
    * @property integer $balance_id
    * @property integer $count
    * @property double $price
*/
class OrderProduct extends EActiveRecord
{
    public function tableName()
    {
        return '{{order_products}}';
    }


    public function rules()
    {
        return array(
            array('product_id, order_id, balance_id, count, price', 'required'),
            array('product_id, order_id, balance_id, count', 'numerical', 'integerOnly'=>true),
            array('price', 'numerical'),
            // The following rule is used by search().
            array('id, product_id, order_id, balance_id, count, price', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array (
            "product"=>array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'product_id' => 'Связь с таблицей products',
            'order_id' => 'Связь с таблицей orders',
            'balance_id' => 'Связь с таблицей баланса',
            'count' => 'Количество заказанного товара',
            'price' => 'Цена за единицу товара',
        );
    }

    public function __get($name){
        if($name=="size"){
            $result = Yii::app()->db->createCommand("SELECT
                                                        c.value value
                                                    FROM
                                                        tbl_balances as b
                                                    LEFT JOIN
                                                        tbl_characteristics as c
                                                    ON
                                                        b.characteristic_code=c.code
                                                    WHERE
                                                        b.id={$this->balance_id};")->queryRow();
            return $result["value"];
        }
        return parent::__get($name);
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('balance_id',$this->balance_id);
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
