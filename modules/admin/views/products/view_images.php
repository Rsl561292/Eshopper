<?php
use yii\helpers\Html;
?>

<div id="row_images">
    <div class="add_block">
        <?php foreach($images as $image):?>
            <div class="image_item">
                <?php if($image->isMain==1):?>
                    <?=Html::img('@web/images/home/action_left.png', ['alt' => 'Action', 'class' => 'newarrival']);?>
                    <div id="image_main" class="image_block" data-id_image="<?=$image->id?>">
                        <?=Html::img($image->getUrl('x100'),['alt'=>'Image'])?>
                    </div>
                <?php else:?>
                    <div class="image_block" data-image="<?=$image->id?>">
                        <?=Html::img($image->getUrl('x100'),['alt'=>'Image'])?>
                    </div>
                <?php endif;?>
            </div>
        <?php endforeach;?>
    </div>
</div>