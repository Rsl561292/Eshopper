<?php

/* @var $this yii\web\View */

use app\components\MenuWidget;
use app\components\Brands_menuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<section id="advertisement">
    <div class="container">
        <?=Html::img('@web/images/shop/advertisement.jpg',['alt'=>''])?>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?= MenuWidget::widget(['tpl'=>'menu'])?>
                    </ul>

                    <div class="brands_products"><!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <?= Brands_menuWidget::widget(['tpl'=>'brand_menu'])?>
                            </ul>
                        </div>
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <?=Html::img('@web/images/home/shipping.jpg',['alt'=>''])?>
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <?php if(empty($productss)): ?>
                        <h2 class="title text-center">Products not found</h2>
                    <?php endif; ?>

                    <?php if(!empty($productss)): ?>
                        <h2 class="title text-center">Found <?=$count_record?> products brand: <?=$brand->name?>.</h2>
                            <?php $kl=0?>
                            <?php foreach($productss as $product):?>
                                <?php $kl+=1;
                                if($kl==1){
                                    echo '<div class="row">';
                                }
                                ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <?= Html::img('@web/images/products/'.$product['img'],['alt'=>'Image product'])?>
                                                <h2>$<?=$product['price']?></h2>
                                                <p><a href="<?=Url::to(['products/view_details','id_product'=>$product['id']])?>" class="product_url"><?=$product['name']?></a></p>
                                                <a href="<?=Url::to(['cart/add','id_add'=>$product['id']])?>" data-id_add="<?=$product['id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>

                                            <?php
                                            if($product['new']=='1'){
                                                echo Html::img('@web/images/home/new.png', ['alt' => 'New', 'class' => 'new']);
                                            }elseif($product['sale']=='1'){
                                                echo Html::img('@web/images/home/sale.png', ['alt' => 'Sale', 'class' => 'new']);
                                            }
                                            ?>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if($kl==3) {
                                    echo '</div >';
                                    $kl=0;
                                }
                                ?>
                            <?php endforeach;?>
                        <?php
                            if(!($kl==0)) {
                                echo '</div >';
                            }
                        // display pagination
                            echo LinkPager::widget([
                                'pagination' => $pages,
                            ]);
                        ?>
                    <?php endif;?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
