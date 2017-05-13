<?php

/* @var $this yii\web\View */

use app\components\MenuWidget;
use app\components\Brands_menuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
?>

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

                    <div class="shipping text-center"><!--shipping-->
                        <img src="/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <?php
                                $img=$product->getImage();
                                echo Html::img($img->getUrl(),['alt'=>'Main image product']);?>
                            <h3>ZOOM</h3>
                        </div>

                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php
                                    $img=$product->getImages();
                                    $index=0;
                                    $index_item=0;
                                    foreach($img as $item_img){
                                        $index++;
                                        if($index==1){
                                            if(($index_item)==0){
                                                echo '<div class="item active">';
                                            }else{
                                                echo '<div class="item">';
                                            }
                                            $index_item++;
                                        }
                                                echo '<a href=""><img src='.$item_img->getUrl("80x").' alt="img"></a>';

                                        if($index==3){
                                            echo '</div>';
                                            $index=0;
                                        }
                                    }
                                    if(!($index==3)){
                                        echo '</div>';
                                    }
                                ?>
                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>

                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <!--<img src="/images/product-details/new.jpg" class="newarrival" alt="" />-->
                            <?php
                                if($product->new=='1'){
                                    echo Html::img('@web/images/home/new_left.png', ['alt' => 'New', 'class' => 'newarrival']);
                                }
                                if($product->sale=='1'){
                                    echo Html::img('@web/images/home/sale.png', ['alt' => 'Sale', 'class' => 'new']);
                            }
                            ?>
                            <h2><?=$product->name?></h2>
                            <p>Web ID: <?=$product->id?></p>
                            <img src="/images/product-details/rating.png" alt="" />
								<span>
									<span>US $<?=$product->price?></span>
									<label>Quantity:</label>
									<input type="text" value="1" id="qty"/>
									<a href="<?=Url::to(['cart/add','id_add'=>$product->id])?>" data-id_add="<?=$product->id?>"class="btn btn-fefault add-to-cart cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </a>
								</span>
                            <?php
                                if($product->availability_of=='1')
                                    echo"<p><b>Availability of:</b> In Stock</p>";
                                else
                                    echo"<p><b>Availability of:</b> Do not have</p>";
                            ?>

                            <p class="detail_brand"><b>Brand:</b> <a href="<?=Url::to(['site/view_brand_products','id_brand'=>$product->brands->id])?>"><?=$product->brands->name?></a></p>
                            <a href=""><img src="/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Description product</a></li>
                            <li><a href="#companyprofile" data-toggle="tab">Description brand</a></li>
                            <li><a href="#tag" data-toggle="tab">Tag</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            <div class="container_detail_product">
                                <p><?=$product->content?></p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="companyprofile" >
                            <div class="container_detail_product">
                                <p><?=$product->brands->coment?></p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tag" >
                            <div class="container_detail_product">
                                <p>Tag: <?=$product->brands->keywords?></p>
                            </div>
                        </div>

                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                                    <textarea name="" ></textarea>
                                    <b>Rating: </b> <img src="/images/product-details/rating.png" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->

                <?php if(!empty($rec_products)):?>
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                    $index_col=0;
                                    $item_count=0;
                                    foreach($rec_products as $rec_product):?>
                                    <?php
                                        $index_col++;
                                        if($index_col==1){
                                            if($item_count==0){
                                                echo '<div class="item active">';
                                            }else{
                                                echo '<div class="item">';
                                            }
                                            $item_count++;
                                        }
                                    ?>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <?= Html::img('@web/images/products/'.$rec_product['img'],['alt'=>'Image product'])?>
                                                        <h2>$<?=$rec_product['price']?></h2>
                                                        <p><a href="<?=Url::to(['products/view_details','id_product'=>$rec_product['id']])?>" class="product_url"><?=$rec_product['name']?></a></p>
                                                        <a href="<?=Url::to(['cart/add','id_add'=>$rec_product['id']])?>" data-id_add="<?=$rec_product['id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    </div>

                                                    <?php
                                                        if($rec_product['new']=='1'){
                                                            echo Html::img('@web/images/home/new_left.png', ['alt' => 'New', 'class' => 'newarrival']);
                                                        }
                                                        if($rec_product['sale']=='1'){
                                                            echo Html::img('@web/images/home/sale.png', ['alt' => 'Sale', 'class' => 'new']);
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    if($index_col==3){
                                       echo '</div>';
                                        $index_col=0;
                                    }
                                ?>
                                <?php endforeach;
                                    if(!($index_col==0)){
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->
                <?php endif;?>

            </div>
        </div>
    </div>
</section>
