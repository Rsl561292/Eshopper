<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">
    <div id="form_udate_date">
        <div class="register-req">
            <p><?=!$model->isNewRecord ?'You updating brand id  '.$model->id: 'You create new brand'?>.</p>
        </div><!--/register-req-->


        <div class="shopper-informations">
            <?php $form=ActiveForm::begin()?>
            <div class="shopper-info">
                <div class="row">
                    <div class="col-sm-5">
                        <?= $form->field($model, 'name', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter name brand...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-7">
                        <?= $form->field($model, 'keywords', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter meta keywords for brand...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'description', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter meta description for brand...',
                            ],
                        ])->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="order-message">
                            <?= $form->field($model, 'coment', [
                                'inputOptions' => [
                                    'placeholder' => 'Please enter description the brand...',
                                ],
                            ])->textarea(['rows'=>7])->widget(CKEditor::className(),[
                                'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php ActiveForm::end();?>
        </div>
    </div>

</div>
