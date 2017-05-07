<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brands-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
