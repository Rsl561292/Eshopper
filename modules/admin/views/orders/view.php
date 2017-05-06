<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */

$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details_view_information">

    <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success');?>
        </div>
    <?php endif?>

    <div class="row">
        <div class="col-xm-12 col-sm-8">
            <h1>Order number <span><?=$model->id?></span> from client <span><?= Html::encode($this->title) ?></span></h1>
        </div>

        <div class="col-xm-12 col-sm-4">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn_views_detail']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn_views_detail',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            [
                'attribute'=>'status',
                'value'=> !$model->status? '<span class="text-danger">Active</span>': '<span class="text-success">Closed</span>',
                'format'=>'html',
            ],
            'qty',
            'sum',
            'shipping_cost',
            'eco_tax',
            //'status',
            'name',
            'email:email',
            'phone',
            'address',
            'notes',
        ],
    ]) ?>

    <?php $items=$model->orderItems;?>
    <section id="cart_items">
        <div class="table-responsive cart_info">
            <table class="table table-hover table-striped table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="description">Name product</td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($items as $item):?>
                    <tr>
                        <td class="cart_description">
                            <h4><a href="<?=Url::to(['/products/view_details','id_product'=>$item['id']])?>"><?=$item['name_product']?></a></h4>
                            <p>Web ID: <?=$item['id']?></p>
                        </td>
                        <td class="cart_price">
                            <p><?=$item['price']?></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="text" name="quantity" value="<?=$item['qty_item']?>" autocomplete="off" size="2">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$<?=$item['sum_item']?></p>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>


</div>
