<?php

/**
* This is the model class for table "{{brands}}".
*
* The followings are the available columns in table '{{brands}}':
    * @property integer $id
    * @property string $code
    * @property string $img_photo
    * @property string $name
    * @property string $wswg_desc
    * @property string $create_time
    * @property string $update_time
*/
class Brand extends EActiveRecord
{
    public function tableName()
    {
        return '{{brands}}';
    }


    public function rules()
    {
        return array(
            array('create_time, update_time', 'required'),
            array('code', 'length', 'max'=>20),
            array('img_photo, name', 'length', 'max'=>255),
            array('wswg_desc', 'safe'),
            // The following rule is used by search().
            array('id, code, img_photo, name, wswg_desc, create_time, update_time', 'safe', 'on'=>'search'),
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
            'code' => 'Код в 1С',
            'img_photo' => 'Изображение',
            'name' => 'Название',
            'wswg_desc' => 'Описание',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'imgBehaviorPhoto' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_photo',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
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
		$criteria->compare('img_photo',$this->img_photo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('wswg_desc',$this->wswg_desc,true);
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


}
