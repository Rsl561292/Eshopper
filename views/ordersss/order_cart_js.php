<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table_item_photo">
                                <?php $img=$product->getImage();
                                    echo Html::img($img->getUrl('x80'),['alt'=>'Image product'])?></td>
                            <td class="cart_description">
                                <h4><a href="<?=Url::to(['products/view_details','id_product'=>$product->id])?>"><?=$product->name?></a></h4>
                                <p>Web ID: <?=$product->id?></p>
                            </td>
                            <td class="cart_price"><p><?=$product->price?></p></td>
                            <td class="cart_quantity">
                                <p><?=$qty?></p>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$<?=$product->price*$qty?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
