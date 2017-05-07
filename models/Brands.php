<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property integer $id
 * @property string $name
 * @property integer $count
 * @property string $keywords
 * @property string $description
 * @property string $coment
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands';
    }

    public function getProduct(){
        return $this->hasMany(Products::className(),['brand_id'=>'id']);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['count'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['keywords', 'description', 'coment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'count' => 'Count product brand',
            'keywords' => 'Keywords',
            'description' => 'Meta description',
            'coment' => 'Description brand',
        ];
    }

    public function deleteBrand(){
        $rez=Products::find()->where(['brand_id'=>$this->id])->count();
        if($rez==0){
            if($this->delete()){
                return true;
            }else{
                return false;
            }
        }else{
            return 12;
        }
    }
}
