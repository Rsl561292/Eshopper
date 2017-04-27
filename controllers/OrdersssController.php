<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 27.04.2017
 * Time: 14:49
 */

namespace app\controllers;


use app\models\Orders;
use app\models\OrderItems;
use Yii;

class OrdersssController extends AppController
{
    public function actionPlace_order(){
        $session=Yii::$app->session;
        $session->open();
        $order=new Orders();
        return $this->render('place_order',compact('session','order'));
    }

}