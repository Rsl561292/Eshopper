<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */

$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-update">
    <div id="form_udate_date">
        <div class="register-req">
            <p>You updating order number <?=$model->id?>.</p>
        </div><!--/register-req-->


        <div class="shopper-informations">
            <?php $form=ActiveForm::begin()?>
            <div class="shopper-info">
                <div class="row">
                    <div class="col-sm-5">
                        <?= $form->field($model, 'shipping_cost', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter shipping cost...',
                            ],
                        ])->textInput() ?>
                    </div>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'eco_tax', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter eco tax...',
                            ],
                        ])->textInput() ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'status')->dropDownList([ '0'=>'Active', '1'=>'Closed']) ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'name', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter name shopper...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter email shopper...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-sm-6">
                        <?= $form->field($model, 'phone', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter phone shopper...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'address', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter address shopper...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="order-message">
                        <?= $form->field($model, 'notes', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter notes for order...',
                            ],
                        ])->textarea(['rows'=>10]) ?>
                    </div>
                </div>
            </div>

            <?= Html::submitButton('Update', ['class' =>'btn btn-primary']) ?>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>
