<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 05.04.2017
 * Time: 21:32
 */

namespace app\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getProduct(){
        return $this->hasMany(Products::className(),['categoty_id'=>'id']);
    }

}