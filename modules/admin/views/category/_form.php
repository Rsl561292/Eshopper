<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <div id="form_udate_order">
        <div class="register-req">
            <p><?=!$model->isNewRecord ?'You updating category number  '.$model->id: 'You create new category'?>.</p>
        </div><!--/register-req-->


        <div class="shopper-informations">
            <?php $form=ActiveForm::begin()?>
            <div class="shopper-info">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group field-category-parent_id has-success">
                            <label class="control-label" for="category-parent_id">Parent category</label>
                            <select id="category-parent_id" class="form-control" name="Category[parent_id]" aria-invalid="false">
                                <option value="0">Independent category</option>
                                <?=\app\components\MenuWidget::widget(['tpl'=>'select','model'=>$model])?>
                            </select>
                        </div>
                        <?= $form->field($model, 'name', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter name category...',
                            ],
                        ])->textInput() ?>
                        <?= $form->field($model, 'keywords', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter keywords...',
                            ],
                        ])->textInput() ?>
                        <?= $form->field($model, 'description', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter meta description...',
                            ],
                        ])->textInput() ?>
                    </div>
                </div>
            </div>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php ActiveForm::end();?>
        </div>
    </div>

</div>
