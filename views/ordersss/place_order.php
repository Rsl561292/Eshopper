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
        <?php if(Yii::$app->session->hasFlash('success')):?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <?php echo Yii::$app->session->getFlash('success');?>
                </div>
            <?php else:?>
                <?php if(Yii::$app->session->hasFlash('errorteh')):?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <?php echo Yii::$app->session->getFlash('errorteh');?>
                    </div>
                <?php else:?>
                    <div class="breadcrumbs">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Check out</li>
                        </ol>
                    </div><!--/breadcrums-->

                    <div class="register-req">
                        <p>Please complete information about yourself.</p>
                    </div><!--/register-req-->

                    <?php if(Yii::$app->session->hasFlash('error')):?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('error');?>
                        </div>
                    <?php endif;?>

                    <div class="shopper-informations">
                        <div class="row">
                            <?php $form=ActiveForm::begin()?>
                            <div class="col-sm-6">
                                <div class="shopper-info">
                                    <p>Shopper Information</p>
                                    <?= $form->field($order,'name', [
                                        'inputOptions' => [
                                            'placeholder' => 'Please enter your name...',
                                        ],
                                    ])->label(false)?>
                                    <?= $form->field($order,'email', [
                                        'inputOptions' => [
                                            'placeholder' => 'Please enter your email...',
                                        ],
                                    ])->label(false)?>
                                    <?= $form->field($order,'phone', [
                                        'inputOptions' => [
                                            'placeholder' => 'Please enter your phone...',
                                        ],
                                    ])->label(false)?>
                                    <?= $form->field($order,'address', [
                                        'inputOptions' => [
                                            'placeholder' => 'Please enter your address...',
                                        ],
                                    ])->label(false)?>
                                    <a class="btn btn-primary" href="<?=Url::home()?>">Return to home</a>
                                    <?=Html::submitButton('Send order',['class'=>'btn btn-primary'])?>
                                    <a class="btn btn-primary" href="<?=Url::to(['cart/index'])?>">Cart</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="order-message">
                                    <p>Shipping Order</p>
                                    <?= $form->field($order,'notes', [
                                        'inputOptions' => [
                                            'placeholder' => 'Notes about your order, Special Notes for Delivery...',
                                        ],
                                    ])->textarea(['rows'=>16])->label(false)?>
                                </div>
                            </div>
                            <?php ActiveForm::end();?>
                        </div>
                    </div>



                    <div class="review-payment">
                        <h2>Review & Payment</h2>
                    </div>

                    <div class="table-responsive cart_info">
                        <table class="table table-hover table-striped table-condensed">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description"></td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($session['cart'] as $id=>$items):?>
                                <tr>
                                    <td class="table_item_photo"><?=Html::img($items['img'],['alt'=>'Image product'])?>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="<?=Url::to(['products/view_details','id_product'=>$id])?>"><?=$items['name']?></a></h4>
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


                    <div class="row row_data_all">
                        <div class="col-sm-8">
                            <div class="payment-options">
                            <span>
                                <label><input type="checkbox"> Direct Bank Transfer</label>
                            </span>
                            <span>
                                <label><input type="checkbox"> Check Payment</label>
                            </span>
                            <span>
                                <label><input type="checkbox"> Paypal</label>
                            </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="table table_all">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>$<?=$session['cart,sum']?></td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>2%</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr id="total_all">
                                        <td>Total</td>
                                        <td><span>$<?=$session['cart,sum']+($session['cart,sum']/100)*2?></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
        <?php endif;?>
    </div>
</section> <!--/#cart_items-->


