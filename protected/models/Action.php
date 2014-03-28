<?php

/**
* This is the model class for table "{{actions}}".
*
* The followings are the available columns in table '{{actions}}':
    * @property integer $id
    * @property string $name
    * @property string $wswg_desc
    * @property string $wswg_concurs_desc
    * @property string $img_photo
    * @property string $video
    * @property integer $gllr_photos
    * @property integer $gllr_concurs
    * @property string $dt_date
    * @property string $create_time
    * @property string $update_time
*/
class Action extends EActiveRecord
{
    public $photo;

    public function tableName()
    {
        return '{{actions}}';
    }

    public function translition(){
        return "События";
    }

    public function rules()
    {
        return array(
            array('name, wswg_desc', 'required'),
            array('gllr_photos, gllr_concurs', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('video', 'length', 'max'=>512),
            array('wswg_concurs_desc, dt_date, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, wswg_desc, wswg_concurs_desc, img_photo, video, gllr_photos, gllr_concurs, dt_date, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            "concursGallery"=>array(self::BELONGS_TO, 'Gallery', 'gllr_concurs'),
            "photoGallery"=>array(self::BELONGS_TO, 'Gallery', 'gllr_photos'),
        );
    }

    public function save($runValidation=true,$attributes=null)
    {
        if(!$runValidation || $this->validate($attributes))
            return $this->getIsNewRecord() ? $this->insert($attributes) : $this->update($attributes);
        else
            return false;
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'wswg_desc' => 'Описание события',
            'wswg_concurs_desc' => 'Описание конкурса',
            'img_photo' => 'Изображение',
            'video' => 'ID Видео из Vimeo.com',
            'gllr_photos' => 'Галерея фоток события',
            'gllr_concurs' => 'Галерея конкурсных работ',
            'dt_date' => 'Дата проведения',
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
					'small' => array(
                        'centeredpreview' => array(80, 80),
					),
                    'normal' => array(
                        'resize' => array(320, 200),
                    )
				),
			),
			'galleryBehaviorPhotos' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_photos',
				'versions' => array(
                    'small' => array(
                        'resize' => array(80, 80),
                    ),
                    'normal' => array(
                        'resize' => array(220, 220),
                    ),
                    'big' => array(
                        'resize' => array(640, 420),
                    )
				),
				'name' => true,
				'description' => true,
			),
			'galleryBehaviorConcurs' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_concurs',
				'versions' => array(
                    'small' => array(
                        'resize' => array(80, 80),
                    ),
                    'normal' => array(
                        'resize' => array(220, 220),
                    ),
                    'big' => array(
                        'resize' => array(640, 420),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('wswg_desc',$this->wswg_desc,true);
		$criteria->compare('wswg_concurs_desc',$this->wswg_concurs_desc,true);
		$criteria->compare('img_photo',$this->img_photo,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('gllr_photos',$this->gllr_photos);
		$criteria->compare('gllr_concurs',$this->gllr_concurs);
		$criteria->compare('dt_date',$this->dt_date,true);
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

	public function beforeSave()
	{
		if (!empty($this->dt_date))
			$this->dt_date = Yii::app()->date->toMysql($this->dt_date);
		return parent::beforeSave();
	}

    public function beforeValidate(){
        $this->photo = $this->img_photo;
        return parent::beforeValidate();
    }

    public function afterValidate(){
        $this->img_photo = $this->photo;
        return parent::afterValidate();
    }

	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) { 
			$this->dt_date = ($this->dt_date !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_date)) : '';
		}
	}


}
