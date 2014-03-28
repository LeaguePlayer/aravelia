<?php

class reviewsWidget extends CWidget {

    public function run() {
        Yii::import("application.models.Review");

        $criteria = new CDbCriteria;

        $criteria->addCondition("status=1");

        $count = Review::model()->count($criteria);

        $criteria->limit = 4;

        if($count>4) {
            $offset = rand(0, $count-4);
            $criteria->offset = $offset;
        }

        $data["reviews"] = Review::model()->findAll($criteria);

        $this->render("index", $data);
    }

}