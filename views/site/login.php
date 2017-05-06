<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <?php // Yii::$app->getSecurity()->generatePasswordHash('123');
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <div class="col-sm-8">
            <div class="login-form"><!--login form-->
                <h2>Login to your account</h2>
                <?= $form->field($model, 'username', [
                    'inputOptions' => [
                        'placeholder' => 'User name/email',
                    ],
                ])->textInput(['autofocus' => true])->label(false) ?>
                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'placeholder' => 'Password',
                    ],
                ])->passwordInput()->label(false) ?>
                <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",],false) ?>
                <?= Html::submitButton('Login',['class'=>'btn btn-primary'])?>
            </div><!--/login form-->
        </div>
        <?php ActiveForm::end(); ?>
</div>