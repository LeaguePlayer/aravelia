<?php

/**
* This is the model class for table "{{orders}}".
*
* The followings are the available columns in table '{{orders}}':
    * @property integer $id
    * @property integer $type
    * @property string $name
    * @property string $phone
    * @property string $email
    * @property string $address
    * @property string $comment
    * @property string $payment
    * @property integer $delivery
    * @property string $create_time
    * @property string $update_time
*/
class Order extends EActiveRecord
{
    private static $_types = array(
        "product" => "1",
        "mobile" => "2",
        "sertificat" => "3",
    );

    private static $_typesLabel = array(
        "1" => "Товары",
        "2" => "Мобильный продавец",
        "3" => "Сертификат",
    );

    private static $_statuses = array(
        "new" => "1",
        "old" => "2",
    );

    private static $_statusesLabel = array(
        "1" => "Новый",
        "2" => "Просмотренный",
    );

    public function tableName()
    {
        return '{{orders}}';
    }

    public function defaultScope(){
        return array(
            "order"=>"create_time DESC",
        );
    }


    public function rules()
    {
        return array(
            array('name, phone', 'required'),
            array('type, status', 'numerical', 'integerOnly'=>true),
            array('name, email, payment', 'length', 'max'=>255),
            array('phone', 'length', 'max'=>20),
            array('address, comment, delivery, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, type, name, phone, email, address, comment, payment, delivery, status, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            "orderCertificates"=>array(self::HAS_MANY, 'OrderCertificate', 'order_id'),
            "orderProducts"=>array(self::HAS_MANY, 'OrderProduct', 'order_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Тип заказа',
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'address' => 'Адрес',
            'comment' => 'Комментарий',
            'payment' => 'Тип оплаты',
            'delivery' => 'Тип доставки',
            'status' => 'Статус',
            'create_time' => 'Дата',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('payment',$this->payment,true);
		$criteria->compare('delivery',$this->delivery);
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

    public function __get($name){
        if($name == "price"){
            if($this->type == self::getType("sertificat"))
                return $this->getCertPrice();
            if($this->type == self::getType("product") || $this->type == self::getType("mobile"))
                return $this->getProductPrice();
            return null;
        }
        return parent::__get($name);
    }

    public static function getType($type){
        return self::$_types[$type];
    }

    public static function getTypeLabel($typeId = null){
        if($typeId === null)
            return self::$_typesLabel;
        return self::$_typesLabel[$typeId];
    }

    public static function getStatus($status){
        return self::$_statuses[$status];
    }

    public static function getStatusLabel($stId = null){
        if($stId === null)
            return self::$_statusesLabel;
        return self::$_statusesLabel[$stId];
    }

    public function getCertPrice(){
        $cert = $this->orderCertificates;
        if($cert){
            $price = 0;
            foreach($cert as $c){
                $price += ($c->price * $c->count);
            }
            return $price;
        }
        return 0;
    }

    public function getProductPrice(){
        $products = $this->orderProducts;
        if($products){
            $price = 0;
            foreach($products as $p){
                $price += ($p->count * $p->price);
            }
            return $price;
        }
        return 0;
    }

    public function afterSave(){
        if(!$this->isNewRecord)
            return true;
        // сохраняем товары
        if($this->type == self::getType("product") || $this->type == self::getType("mobile")){
            $products = json_decode(Yii::app()->request->cookies['products']);
            if($products != null){
                $p_ids = array();
                $b_ids = array();
                $p_count = array();
                foreach($products as $p){
                    $p_ids[] = $p->id;
                    $p_count[$p->id] = $p->count;
                    $b_ids[] = $p->balans_id;
                }

                if(count($p_ids)>0 && count($b_ids)>0){
                    $products = Yii::app()->db->createCommand()
                        ->select("p.id, p.article, p.name, b.id bid, b.price")
                        ->from("tbl_products as p")
                        ->rightJoin("tbl_balances as b", "p.code=b.product_code")
                        ->leftJoin("tbl_characteristics as c", "b.characteristic_code=c.code")
                        ->where(array("and", array("in", "p.id", $p_ids), array("in", "b.id", $b_ids)))
                        ->queryAll();
                    if($products) {
                        foreach($products as $p){
                            Yii::app()->db->createCommand()
                                ->insert("tbl_order_products", array(
                                    "product_id"=>$p["id"],
                                    "order_id"=>$this->id,
                                    "balance_id"=>$p["bid"],
                                    "price"=>$p["price"],
                                    "count"=>$p_count[$p["id"]]
                                ));
                        }
                    }
                }
                unset(Yii::app()->request->cookies['products']);
                return true;
            }
            else {
                $this->delete();
                echo json_encode(array(
                    "success"=>true,
                    "mesage"=>"Товары не найдены"
                ));
                return true;
            }
        }
        elseif($this->type == self::getType("mobile")) {
            return true;
        }
        elseif($this->type == self::getType("sertificat")) {
            if(isset($_POST["sert"]) && isset($_POST["count"])){
                foreach($_POST["sert"] as $id => $val){
                    $sertificat = Yii::app()->db->createCommand()
                        ->select("*")
                        ->from("tbl_certificates")
                        ->where("id=:id", array(":id"=>$id))
                        ->queryRow();
                    if($sertificat){
                        Yii::app()->db->createCommand()
                            ->insert("tbl_order_certificates", array(
                                "order_id"=>$this->id,
                                "certificate_id"=>$sertificat["id"],
                                "count"=>$_POST["count"][$sertificat["id"]],
                                "price"=>$sertificat["price"],
                            ));
                    }
                }
            }
            else {
                $this->delete();
            }
            return true;
        }
        else {
            $this->delete();
            echo json_encode(array(
                "success"=>false,
                "mesage"=>"Товары не найдены"
            ));
            return true;
        }
        return true;
    }
}
