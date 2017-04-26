<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 05.04.2017
 * Time: 21:38
 */

namespace app\models;
use yii\db\ActiveRecord;

class Products extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }

    public function getBrands(){
        return $this->hasOne(Brands::className(),['id'=>'brand_id']);
    }

}