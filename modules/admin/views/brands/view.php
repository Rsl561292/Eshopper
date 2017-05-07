<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brands-view details_view_information">

    <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success');?>
        </div>
    <?php endif?>

    <div class="row">
        <div class="col-xm-12 col-sm-8">
            <h1>Details brand: <span><?= Html::encode($model->name) ?></span></h1>
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
            'name',
            'count',
            'keywords',
            'description',
            'coment',
        ],
    ]) ?>

</div>
