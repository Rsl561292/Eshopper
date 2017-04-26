<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 11.04.2017
 * Time: 0:05
 */

namespace app\controllers;
use app\models\Category;
use app\models\Products;
use Yii;


class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hit_mas=Products::find()->where(['hit'=>'1'])->limit(6)->all();
        return $this->render('index',compact('hit_mas'));
    }

}