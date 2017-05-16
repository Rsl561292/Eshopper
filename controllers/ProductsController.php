<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 20.04.2017
 * Time: 14:56
 */

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Brands;
use app\models\Products;
use yii\web\HttpException;

class ProductsController extends AppController
{
    public function actionView_details()
    {
        $id=Yii::$app->request->get('id_product');//
        $product=Products::findOne($id);
        if(empty($product)){
            //$this->layout="error";
            throw new HttpException(404,'Selection of the product does not exist!');
        }

        $rec_products=Products::find()->where(['recommended'=>'1','category_id'=>$product->category_id])->all();
        return $this->render('view_details',compact('product','rec_products'));

    }

}