<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 22.04.2017
 * Time: 14:37
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Products;
use yii\bootstrap\Html;
use Yii;

class CartController extends AppController
{
    public function actionIndex()
    {
        $session=Yii::$app->session;
        $session->open();
        //unset($_SESSION['cart']);
        return $this->render('index',compact('session'));
    }

    public function actionAdd()
    {
        $id=trim(Html::encode(Yii::$app->request->get('id_add')));
        $qty=(int)(trim(Html::encode(Yii::$app->request->get('qty'))));
        $qty=abs(!$qty?1:$qty);
        $product=Products::findOne(['id'=>$id]);
        if(empty($product)) return false;

        $session=Yii::$app->session;
        $session->open();
        $model_cart=new Cart();
        $model_cart->addToCart($product,$qty);

        if(Yii::$app->request->isAjax){
            $this->layout=false;
        }

        return $this->render('cart-modal',compact('product','qty'));
        //$session->remove('cart');
        //unset($_SESSION['cart']);
    }

    public function actionClear_all_cart()
    {
        $session=Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart,qty');
        $session->remove('cart,sum');
        return $this->render('index',compact('session'));
    }

    public function actionDel_item()
    {
        $id=trim(Html::encode(Yii::$app->request->get('id_del')));

        $session=Yii::$app->session;
        $session->open();
        $model_cart=new Cart();
        $answer=$model_cart->delItem($id);
        if(Yii::$app->request->isAjax){
            if($answer){
                $this->layout=false;
            }else{
                return false;
            }
        }
        return $this->render('index',compact('session'));
    }

    public function actionAdd_one_unit()
    {
        $id=trim(Html::encode(Yii::$app->request->get('id_product')));

        $session=Yii::$app->session;
        $session->open();
        $model_cart=new Cart();
        $answer=$model_cart->addOneUnitProductToCart($id);
        if(Yii::$app->request->isAjax){
            if($answer){
                $this->layout=false;
            }else{
                return false;
            }
        }
        return $this->render('index',compact('session'));
    }

    public function actionDel_one_unit()
    {
        $id=trim(Html::encode(Yii::$app->request->get('id_product')));

        $session=Yii::$app->session;
        $session->open();
        $model_cart=new Cart();
        $answer=$model_cart->delOneUnitProductToCart($id);
        if(Yii::$app->request->isAjax){
            if($answer){
                $this->layout=false;
            }else{
                return false;
            }
        }
        return $this->render('index',compact('session'));
    }

}