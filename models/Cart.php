<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 22.04.2017
 * Time: 14:34
 */

namespace app\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }


    public function addToCart($product, $qty=1){
        if($_SESSION['cart'][$product->id]){
            $_SESSION['cart'][$product->id]['qty']+=$qty;
            $_SESSION['cart'][$product->id]['sum']+=$qty*$product->price;
        }else{
            $img=$product->getImage();
            $_SESSION['cart'][$product->id]=[
            'qty'=>$qty,
            'name'=>$product->name,
            'img'=>$img->getUrl('x80'),
            'price'=>$product->price,
            'sum'=>$product->price*$qty
        ];
        }
        $_SESSION['cart,qty']=$_SESSION['cart,qty']? $_SESSION['cart,qty']+$qty:$qty;
        $_SESSION['cart,sum']=$_SESSION['cart,sum']? $_SESSION['cart,sum']+($qty*$product->price):$qty*$product->price;
    }

    public function delItem($id_product){

        if($_SESSION['cart'][$id_product]){
            $_SESSION['cart,qty']-=$_SESSION['cart'][$id_product]['qty'];
            $_SESSION['cart,sum']-=$_SESSION['cart'][$id_product]['sum'];
            unset($_SESSION['cart'][$id_product]);
            return true;
        }else
            return false;
    }

    public function addOneUnitProductToCart($id_product){
        if($_SESSION['cart'][$id_product]){
            $_SESSION['cart'][$id_product]['qty']++;
            $_SESSION['cart'][$id_product]['sum']+=$_SESSION['cart'][$id_product]['price'];

            $_SESSION['cart,qty']++;
            $_SESSION['cart,sum']+=$_SESSION['cart'][$id_product]['price'];
            return true;
        }else
            return false;
    }

    public function delOneUnitProductToCart($id_product){
        if($_SESSION['cart'][$id_product]){
            $_SESSION['cart'][$id_product]['qty']--;
            $_SESSION['cart'][$id_product]['sum']-=$_SESSION['cart'][$id_product]['price'];

            $_SESSION['cart,qty']--;
            $_SESSION['cart,sum']-=$_SESSION['cart'][$id_product]['price'];
            if($_SESSION['cart'][$id_product]['qty']==0){
                $this->delItem($id_product);
            }
            return true;
        }else
            return false;
    }

}