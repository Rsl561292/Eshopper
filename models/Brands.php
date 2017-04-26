<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 20.04.2017
 * Time: 19:42
 */

namespace app\models;
use yii\db\ActiveRecord;


class Brands extends ActiveRecord
{
    public static function tableName()
    {
        return 'brands';
    }

    public function getProduct(){
        return $this->hasMany(Products::className(),['brand_id'=>'id']);
    }

}