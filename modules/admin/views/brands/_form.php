<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">
    <div id="form_udate_date">
        <div class="register-req">
            <p>You updating brand number <?=$model->id?>.</p>
        </div><!--/register-req-->


        <div class="shopper-informations">
            <?php $form=ActiveForm::begin()?>
            <div class="shopper-info">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'name', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter name brand...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'keywords', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter meta keywords for brand...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'description', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter meta description for brand...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>

                    </div>

                    <div class="col-sm-6">
                        <div class="order-message">
                            <?= $form->field($model, 'coment', [
                                'inputOptions' => [
                                    'placeholder' => 'Please enter description the brand...',
                                ],
                            ])->textarea(['rows'=>15]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php ActiveForm::end();?>
        </div>
    </div>

</div>
