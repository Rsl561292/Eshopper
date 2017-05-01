<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Contact <strong>Us</strong></h2>
                <div id="gmap" class="contact-map">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Get In Touch</h2>

                    <?php if(Yii::$app->session->hasFlash('contact_success')):?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('contact_success');?>
                        </div>
                    <?php else:?>
                            <?php if(Yii::$app->session->hasFlash('contact_error')):?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <?php echo Yii::$app->session->getFlash('contact_error');?>
                                </div>
                            <?php endif;?>
                    <?php endif;?>

                    <?php $form_contact=ActiveForm::begin([
                        'id'=>'main-contact-form',
                        'options'=>[
                            'class'=>'contact-form row'
                        ],
                        'method'=>'post'
                    ])?>
                        <div class="form-group col-md-6">
                            <?=$form_contact->field($model,'name',[
                                'options'=>[
                                    'class'=>'contact-form row'
                                ],
                                'inputOptions' => [
                                    'placeholder' => 'Name...',
                                    'required'=>'required'
                                ],
                            ])->label(false)?>
                        </div>
                        <div class="form-group col-md-6">
                            <?=$form_contact->field($model,'email',[
                                'options'=>[
                                    'class'=>'contact-form row'
                                ],
                                'inputOptions' => [
                                    'placeholder' => 'Email...',
                                    'required'=>'required'
                                ],
                            ])->label(false)?>
                        </div>
                        <div class="form-group col-md-12">
                            <?=$form_contact->field($model,'subject',[
                                'options'=>[
                                    'class'=>'contact-form row'
                                ],
                                'inputOptions' => [
                                    'placeholder' => 'Subject...',
                                    'required'=>'required'
                                ],
                            ])->label(false)?>
                        </div>
                        <div class="form-group col-md-12">
                            <?=$form_contact->field($model,'body',[
                                'options'=>[
                                    'id'=>'message',
                                    'class'=>'contact-form row'
                                ],
                                'inputOptions' => [
                                    'placeholder' => 'Your Message Here...',
                                    'required'=>'required'
                                ],
                            ])->textarea(['rows'=>8])->label(false)?>
                        </div>
                        <div class="form-group col-md-12">
                            <?=Html::submitButton('Submit',['class'=>'btn btn-primary pull-right'])?>
                        </div>
                    <?php ActiveForm::end();?>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Contact Info</h2>
                    <address>
                        <p>E-Shopper Inc.</p>
                        <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                        <p>Newyork USA</p>
                        <p>Mobile: +2346 17 38 93</p>
                        <p>Fax: 1-714-252-0026</p>
                        <p>Email: info@e-shopper.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Social Networking</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->
