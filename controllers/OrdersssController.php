<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 27.04.2017
 * Time: 14:49
 */

namespace app\controllers;


use app\models\Orders;
use Yii;

class OrdersssController extends AppController
{
    public function actionPlace_order(){
        $session=Yii::$app->session;
        $session->open();
        $order=new Orders();

        if($order->load(Yii::$app->request->post())){
            if($order->validate()){
                if(!$order->saveOrderAll($session['cart'],$session['cart,qty'],$session['cart,sum'])){
                    Yii::$app->session->setFlash('errorteh','These save failed due to technical problems. Come later. We\'re sorry.');
                    return $this->refresh();
                }
                Yii::$app->session->setFlash('success','Your order accepted. Manager will contact you shortly');


                    //manager
                    $order_id=$order->id;
                    Yii::$app->mailer->compose('order_manager', compact('session','order'))
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo(Yii::$app->params['managerEmail'])
                        ->setSubject('Order from client')
                        ->send();

                    Yii::$app->mailer->compose('order_shopper', compact('session','order_id'))
                        ->setFrom([Yii::$app->params['adminEmail']=>'With E-shop'])
                        ->setTo($order->email)
                        ->setSubject('Your order on site E-shop')
                        ->send();

                $session->remove('cart');
                    $session->remove('cart,qty');
                    $session->remove('cart,sum');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error','You make a mistake when entering information. Please correct it.');
            }

        }
        $this->setMeta('E-Shoper|Place order');
        return $this->render('place_order',compact('session','order'));
    }

}