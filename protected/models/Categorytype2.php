<?php

/**
* This is the model class for table "{{category_type}}".
*
* The followings are the available columns in table '{{category_type}}':
    * @property integer $id
    * @property string $name
    * @property integer $step_boy
    * @property integer $step_girl
    * @property integer $step_child
*/
class Categorytype extends EActiveRecord
{
    public function tableName()
    {
        return '{{category_type}}';
    }


    public function rules()
    {
        return array(
            array('name, step_boy, step_girl, step_child', 'required'),
            array('step_boy, step_girl, step_child', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>250),
            // The following rule is used by search().
            array('id, name, step_boy, step_girl, step_child', 'safe', 'on'=>'search'),
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
            'name' => 'Название',
            'step_boy' => 'Шаг для Мальчиков',
            'step_girl' => 'Шаг для Девочек',
            'step_child' => 'Шаг для Малышей',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('step_boy',$this->step_boy);
		$criteria->compare('step_girl',$this->step_girl);
		$criteria->compare('step_child',$this->step_child);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition(){
        return "Типы категорий";
    }

    public static function getData(){
        $result = Yii::app()->db->createCommand()
            ->select('id, name')
            ->from('tbl_category_type')
            ->queryAll();
        if($result){
            $data = array();
            foreach($result as $r){
                $data[$r['id']] = $r['name'];
            }
            return $data;
        }
        return null;
    }

}
