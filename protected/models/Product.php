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
    public $searchCat;
    public $searchBrand;

    public function tableName()
    {
        return '{{products}}';
    }

    public function __get($name){
        if($name == 'issetPhoto') {
            if(!is_numeric($this->gllr_photos))
                return "Нет";
            $result = Yii::app()->db->createCommand("SELECT
                                                *
                                            FROM
                                                gallery_photo as gp
                                            WHERE gp.gallery_id={$this->gllr_photos}")
                ->queryRow();
            if($result && count($result)>0)
                return "Есть";
            else
                return "Нет";
        }
        return parent::__get($name);
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
            array('id, code, article, name, wswg_desc, country, group, gllr_photos, category_code, brand_code, status, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            "category"=>array(self::BELONGS_TO, "Category", array("category_code"=>"code")),
            "brand"=>array(self::BELONGS_TO, "Brand", array("brand_code"=>"code")),
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
            'status' => 'Статус',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
            'category.name'=>'Категория',
            'brand.name'=>'Бренд',
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
        $criteria->with = array("category","brand");
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.code',$this->code,true);
		$criteria->compare('t.article',$this->article,true);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.wswg_desc',$this->wswg_desc,true);
		$criteria->compare('t.country',$this->country,true);
		$criteria->compare('t.group',$this->group,true);
		$criteria->compare('t.status',$this->status,true);
		$criteria->compare('t.gllr_photos',$this->gllr_photos);
		$criteria->compare('category.name',$this->searchCat->name,true);
		$criteria->compare('brand.name',$this->searchBrand->name,true);
		$criteria->compare('t.create_time',$this->create_time,true);
		$criteria->compare('t.update_time',$this->update_time,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public static function getMainPhotoUrl($galleryId = null,$version = null){
        if($galleryId == null || !is_numeric($galleryId))
            return "/media/images/no_photo.png";

        $result = Yii::app()->db->createCommand("SELECT
                                                *
                                            FROM
                                                gallery_photo as gp
                                            WHERE gp.gallery_id={$galleryId} AND gp.main=1")
            ->queryRow();

        if(!$result)
            return "/media/images/no_photo.png";

        if($version != null)
            return "/media/images/".$result["id"].$version.".".$result["ext"];

        return "/media/images/".$result["id"].".".$result["ext"];
    }

    public static function getStatusLabel($id = null){
        $status = array(
            1 => 'Опубликован',
            2 => 'Не опубликован',
        );
        if($id != null)
            return $status[$id];
        return $status;
    }

}
