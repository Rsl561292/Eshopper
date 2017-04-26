<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if(!empty($session['cart'])):?>
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
                        <?php foreach($session['cart'] as $id=>$items):?>
                            <tr>
                                <td class="table_item_photo"><?=Html::img('@web/images/products/'.$items['img'],
                                        ['alt'=>'Image product'])?></td>
                                <td class="cart_description">
                                    <h4><a href="<?=Url::to(['products/view_details','id_product'=>$id])?>"><?=$items['name']?></a></h4>
                                    <p>Web ID: <?=$id?></p>
                                </td>
                                <td class="cart_price"><p><?=$items['price']?></p></td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <button class="cart_quantity_down" data-item="<?=$id?>"> - </button>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="<?=$items['qty']?>" autocomplete="off" size="2">
                                        <button class="cart_quantity_up" data-item="<?=$id?>"> + </button>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">$<?=$items['sum']?></p>
                                </td>
                                <td class="cart_delete">
                                    <a href="<?=Url::to(['cart/del_item','id_del'=>$id])?>" class="cart_quantity_delete" data-item="<?=$id?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                   </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>General data on your cart!</h3>
            </div>
            <div class="total_area">
                <div class="row">
                    <div class="col-sm-6">
                        <ul>
                            <li>Cart Subtotal <span>$<?=$session['cart,sum']?></span></li>
                            <li>Eco Tax <span>2%</span></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>$<?=$session['cart,sum']+(($session['cart,sum']/100)*2)?></span></li>
                        </ul>
                    </div>
                </div>
                <a class="btn btn-default btn_cart update" href="">Update</a>
                <a class="btn btn-default btn_cart place_order" href="">Place order</a>
                <a class="btn btn-default btn_cart" href="<?=Url::to(['cart/clear_all_cart'])?>">Clear cart</a>
            </div>
        </div>
    </section><!--/#do_action-->


<?php else:?>
    <div class="container">
        <h3>Your basket is empty</h3>
    </div>
<?php endif;?>
