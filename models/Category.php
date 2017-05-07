<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function getProduct(){
        return $this->hasMany(Products::className(),['category_id'=>'id']);
    }
    public function getCategory_parent(){
        return $this->hasOne(Category::className(),['id'=>'parent_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID category',
            'parent_id' => 'Parent category',
            'name' => 'Name',
            'keywords' => 'Keywords',
            'description' => 'Meta description',
        ];
    }

    public function deleteCategory(){
        $rez=Products::find()->where(['category_id'=>$this->id])->count();
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
