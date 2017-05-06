<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success');?>
        </div>
    <?php endif?>

    <?php if(Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('error');?>
        </div>
    <?php endif?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            [
              'attribute'=>'status',
              'value'=>function($data){
                  return !$data->status? '<span class="text-danger">Active</span>': '<span class="text-success">Closed</span>';
              },
              'format'=>'html',
            ],
            //'status',
            //'qty',
            'sum',
            [
                'label'=>'Sum for payment',
                'value'=>function($data){
                    return ($data->sum+(($data->sum/100)*$data->eco_tax)+$data->shipping_cost);
                }
            ],
            // 'shipping_cost',
            // 'eco_tax',
            // 'name',
            // 'email:email',
            // 'phone',
            // 'address',
            // 'notes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
