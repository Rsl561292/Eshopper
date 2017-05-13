<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view details_view_information">
    <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success');?>
        </div>
    <?php endif?>

    <div class="row">
        <div class="col-xm-12 col-sm-8">
            <h1>Details category: <span><?= Html::encode($model->name) ?></span></h1>
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
            [
                'attribute'=>'category_id',
                'value'=>$model->category->name,
            ],
            //'category_id',
            [
                'attribute'=>'brand_id',
                'value'=> $model->brands->name? $model->brands->name : ' ',
            ],
            'name',
            'price',
            [
                'attribute'=>'availability_of',
                'label'=>'Is on site',
                'value'=>$model->availability_of=='1'? 'Yes': ' ',
            ],
            [
                'attribute'=>'hit',
                'value'=>$model->hit=='1'? 'Yes': ' ',
            ],
            [
                'attribute'=>'new',
                'value'=>$model->new=='1'? 'Yes': ' ',
            ],
            [
                'attribute'=>'sale',
                'value'=>$model->sale=='1'? 'Yes': ' ',
            ],
            [
                'attribute'=>'recommended',
                'value'=>$model->recommended=='1'? 'Yes': ' ',
            ],
            'keywords',
            'description',
            //'img',
            //'hit',
            //'new',
            //'sale',
            //'recommended',
            //'availability_of',
            'content:html',

        ],
    ]) ?>

    <?php $images=$model->getImages();?>
        <div class="gallery_block">
            <?php include __DIR__.'/view_images.php';?>
        </div>
</div>
