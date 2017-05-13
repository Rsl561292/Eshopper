<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

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

    <div class="title_page_list">
        <h1>List products...</h1>
        <p>
            <?= Html::a('Create new product', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            [
              'attribute'=>'category_id',
              'value'=>function($data){
                  return $data->category->name;
              }
            ],/*
            //'category_id',
            [
                'attribute'=>'brand_id',
                'value'=>function($data){
                    return $data->brands->name;
                }
            ],*/
            //'brand_id',
            'name',
            'price',
            [
                'attribute'=>'availability_of',
                'label'=>'Is on site',
                'value'=>function($data){
                    return $data->availability_of=='1'? 'Yes': ' ';
                }
            ],
            [
                'attribute'=>'hit',
                'value'=>function($data){
                    return $data->hit=='1'? 'Yes': ' ';
                }
            ],
            [
                'attribute'=>'new',
                'value'=>function($data){
                    return $data->new=='1'? 'Yes': ' ';
                }
            ],
            [
                'attribute'=>'sale',
                'value'=>function($data){
                    return $data->sale=='1'? 'Yes': ' ';
                }
            ],
            //'availability_of',
            // 'content:ntext',
            // 'keywords',
            // 'description',
            // 'img',
            // 'hit',
            // 'new',
            // 'sale',
            // 'recommended',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
