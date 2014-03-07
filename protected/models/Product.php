<?php

/**
* This is the model class for table "{{products}}".
*
* The followings are the available columns in table '{{products}}':
    * @property integer $id
    * @property string $code
    * @property string $article
    * @property string $name
    * @property string $wswg_desc
    * @property string $country
    * @property string $group
    * @property integer $gllr_photos
    * @property string $category_code
    * @property string $brand_code
    * @property string $create_time
    * @property string $update_time
*/
class Product extends EActiveRecord
{
    public function tableName()
    {
        return '{{products}}';
    }


    public function rules()
    {
        return array(
            array('code, article, name, group', 'required'),
            array('gllr_photos', 'numerical', 'integerOnly'=>true),
            array('code, category_code, brand_code', 'length', 'max'=>20),
            array('article, group', 'length', 'max'=>100),
            array('name, country', 'length', 'max'=>255),
            array('wswg_desc, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, code, article, name, wswg_desc, country, group, gllr_photos, category_code, brand_code, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
//            "category"=>array(self::BELONGS_TO, "Category", "category_code"),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'code' => 'Код в 1С',
            'article' => 'Артикул',
            'name' => 'Название',
            'wswg_desc' => 'Описание',
            'country' => 'Страна',
            'group' => 'Группа',
            'gllr_photos' => 'Фотки',
            'category_code' => 'Категория',
            'brand_code' => 'Бренд',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'galleryBehaviorPhotos' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_photos',
				'versions' => array(
					'small' => array(
						'adaptiveResize' => array(75, 0),
					),
					'medium' => array(
						'resize' => array(320, 0),
					),
                    'big' => array(
                        'resize' => array(500, 0),
                    )
				),
				'name' => true,
				'description' => true,
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
		$criteria->compare('article',$this->article,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('wswg_desc',$this->wswg_desc,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('group',$this->group,true);
		$criteria->compare('gllr_photos',$this->gllr_photos);
		$criteria->compare('category_code',$this->category_code,true);
		$criteria->compare('brand_code',$this->brand_code,true);
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
