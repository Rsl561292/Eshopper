<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $id
 * @property string $category_id
 * @property integer $brand_id
 * @property string $name
 * @property string $availability_of
 * @property string $content
 * @property double $price
 * @property string $keywords
 * @property string $description
 * @property string $hit
 * @property string $new
 * @property string $sale
 * @property string $recommended
 */
class Products extends \yii\db\ActiveRecord
{
    public $image;
    public $gallery_images;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
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


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'price'], 'required'],
            [['category_id', 'brand_id'], 'integer'],
            [['content'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
            [['availability_of', 'hit', 'new', 'sale', 'recommended'], 'string', 'max' => 1],
            [['image'],'file','extensions'=>'png,jpg'],
            [['gallery_images'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'brand_id' => 'Brand',
            'name' => 'Name',
            'availability_of' => 'Availability Of',
            'content' => 'Description product',
            'price' => 'Price',
            'keywords' => 'Keywords',
            'description' => 'Meta-description',
            'image' => 'Main image',
            'gallery_images' => 'Gallery images',
            'hit' => 'Hit',
            'new' => 'New',
            'sale' => 'Sale',
            'recommended' => 'Recommended',
        ];
    }

    public function upload($sign)
    {
        if ($this->validate()) {
            $path='upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path,$sign);
            unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery()
    {
        if ($this->validate()) {
            foreach($this->gallery_images as $file){
                $path='upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path,false);
                unlink($path);
            }

            return true;
        } else {
            return false;
        }
    }

    public function deleteProductWithImage(){
        $transaction=Yii::$app->db->beginTransaction();
             if($this->delete()){
                $this->removeImages();
                $transaction->commit();
                return true;
            }else{
                $transaction->rollBack();
                return false;
            }
    }
}

