<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 27.04.2017
 * Time: 14:55
 */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<section id="cart_items">
    <div class="container">
        <div class="register-req">
            <p>Your order passed under number <?=$order_id?>. Manager will contact you shortly!</>
        </div><!--/register-req-->


        <div class="register-req">
            <p>Your order product</p>
        </div><!--/register-req-->

        <div class="table-responsive cart_info">
            <table class="table table-hover table-striped table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($session['cart'] as $id=>$items):?>
                    <tr>
                        <td class="cart_description">
                            <h4><a href="<?=Url::to(['products/view_details','id_product'=>$id],true)?>"><?=$items['name']?></a></h4>
                            <p>Web ID: <?=$id?></p>
                        </td>
                        <td class="cart_price">
                            <p><?=$items['price']?></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="text" name="quantity" value="<?=$items['qty']?>" autocomplete="off" size="2">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$<?=$items['sum']?></p>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->


