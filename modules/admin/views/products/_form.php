<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\components\MenuWidget;
use app\components\Brands_menuWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <div id="form_udate_date">
        <div class="register-req">
            <p><?=!$model->isNewRecord ?'You updating product id  '.$model->id: 'You create new product'?>.</p>
        </div><!--/register-req-->


        <div class="shopper-informations">
            <?php
                if($model->isNewRecord){
                    $form=ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action'=>'/admin/products/create?id='.$model->id]);
                }else{
                    $form=ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action'=>'/admin/products/update?id='.$model->id]);
                }
            ?>
            <div class="shopper-info">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group field-products-category_id required has-success">
                            <label class="control-label" for="products-category_id">Category</label>
                            <select id="products-category_id" class="form-control" name="Products[category_id]" aria-required="true" aria-invalid="false">
                                <?=MenuWidget::widget(['tpl'=>'select_product','model'=>$model])?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group field-products-brand_id has-success">
                            <label class="control-label" for="products-brand_id">Brand</label>
                            <select id="products-brand_id" class="form-control" name="Products[brand_id]" aria-invalid="false">
                                <?php if($model->isNewRecord):?>
                                    <option value="0"></option>
                                <?php endif;?>
                                <?= Brands_menuWidget::widget(['tpl'=>'brand_select','model'=>$model])?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <?= $form->field($model, 'name', [
                            'inputOptions' => [
                                'placeholder' => 'Please enter name product...',
                            ],
                        ])?>
                    </div>

                    <div class="col-sm-1">
                        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <?= $form->field($model, 'availability_of')->dropDownList(['0'=>'No','1'=>'Yes'])?>
                    </div>

                    <div class="col-sm-2">
                        <?= $form->field($model, 'hit')->dropDownList(['0'=>'No','1'=>'Yes'])?>
                    </div>

                    <div class="col-sm-2">
                        <?= $form->field($model, 'new')->dropDownList(['0'=>'No','1'=>'Yes'])?>
                    </div>

                    <div class="col-sm-2">
                        <?= $form->field($model, 'sale')->dropDownList(['0'=>'No','1'=>'Yes'])?>
                    </div>

                    <div class="col-sm-3">
                        <?= $form->field($model, 'recommended')->dropDownList(['0'=>'No','1'=>'Yes'])?>
                    </div>
                </div>

                <?php if($model->isNewRecord):?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'keywords', [
                                        'inputOptions' => [
                                            'placeholder' => 'Please enter meta-keywords...',
                                        ],
                                    ])->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'image')->fileInput() ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'gallery_images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <?= $form->field($model, 'description', [
                                'inputOptions' => [
                                    'placeholder' => 'Please enter meta-description...',
                                ],
                            ])->textarea(['rows'=>7]) ?>
                        </div>
                    </div>
                <?php else:?>
                    <div class="row">
                        <div class="col-sm-5">
                            <?= $form->field($model, 'keywords', [
                                'inputOptions' => [
                                    'placeholder' => 'Please enter meta-keywords...',
                                ],
                            ])->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-7">
                            <?= $form->field($model, 'description', [
                                'inputOptions' => [
                                    'placeholder' => 'Please enter meta-description...',
                                ],
                            ])->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <?php $id_product=$model->id?>

                    <div id="row_images">
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

                        <div class="row">
                            <div class="add_block">
                                <?php $images=$model->getImages();?>
                                <?php foreach($images as $image):?>
                                    <div class="image_item">
                                        <?php if($image->isMain==1):?>
                                            <?=Html::img('@web/images/home/action_left.png', ['alt' => 'Action', 'class' => 'newarrival']);?>
                                            <div id="image_main" class="image_block" data-id_image="<?=$image->id?>">
                                                <?=Html::img($image->getUrl('x100'),['alt'=>'Image'])?>
                                            </div>
                                            <div class="btn_block">
                                                <a href="<?=Url::to(['/admin/products/delete_image','id_change'=>$image->id,'id_product'=>$id_product])?>" class="btn btn_image btn-danger btn_delete" data-id_image="<?=$image->id?>" data-id_product="<?=$id_product?>">Delete</a>
                                            </div>
                                        <?php else:?>
                                            <div class="image_block" data-image="<?=$image->id?>">
                                                <?=Html::img($image->getUrl('x100'),['alt'=>'Image'])?>
                                            </div>
                                            <div class="btn_block">
                                                <a href="<?=Url::to(['/admin/products/delete_image','id_change'=>$image->id,'id_product'=>$id_product])?>" class="btn btn_image btn-danger btn_delete" data-id_image="<?=$image->id?>" data-id_product="<?=$id_product?>">Delete  </a>
                                                <a href="<?=Url::to(['/admin/products/do_main_image','id_change'=>$image->id,'id_product'=>$id_product])?>" class="btn btn_image btn-success btn_mark" data-id_image="<?=$image->id?>" data-id_product="<?=$id_product?>">Do main</a>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <div class="add_image_block">
                                <?= $form->field($model, 'gallery_images[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Choice new images') ?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="order-message">
                            <?= $form->field($model, 'content', [
                                'inputOptions' => [
                                    'placeholder' => 'Please enter description the product...',
                                ],
                            ])->textarea(['rows'=>15])->widget(CKEditor::className(),[
                                'editorOptions' =>ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
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
