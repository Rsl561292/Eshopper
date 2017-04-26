<?php
/**
 * Created by PhpStorm.
 * User: mackrais
 * Year: 2016
 * Email: mackraiscms@gmail.com
 * Site: http://mackrais.tk
 */
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $exception \Exception */
/* @var $handler \yii\web\ErrorHandler */

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

?>
<?php if (method_exists($this, 'beginPage')) $this->beginPage(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Server Error</title>
    <style>

    </style>
<body>
<div class="site-error text-center">
    <div class="left_block"><img src="/img/eror404.png"></div>
    <div class="right_block text-left">
        <div class="text-eror-404">Server Error</div>
        <div class="text-descr hidden" >Sorry, the page you were searching doesn't exist</div>
        <div class="text-link"><a href="<?=Url::base(true)?>">Return to the home page &#x2192;</a> </div></div>


</div>

<script>
    $(document).ready(function(){
        $('#yii-debug-toolbar-min').remove();
        ('#ydtb-toolbar').hide();

    })
</script>

<?php if (method_exists($this, 'endBody')) $this->endBody(); // to allow injecting code into body (mostly by Yii Debug Toolbar) ?>
</body>

</html>
<?php if (method_exists($this, 'endPage')) $this->endPage(); ?>
