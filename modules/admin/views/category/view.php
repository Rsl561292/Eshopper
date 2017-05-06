<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details_view_information">

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
                'attribute'=>'parent_id',
                'value'=> $model->category_parent->name?$model->category_parent->name : 'Independent category',
            ],
            //'parent_id',
            'name',
            'keywords',
            'description',
        ],
    ]) ?>

</div>
