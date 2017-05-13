<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

    <?php foreach($images as $image):?>
        <div class="image_item">
            <?php if($image->isMain==1):?>
                <?=Html::img('@web/images/home/action_left.png', ['alt' => 'Action', 'class' => 'newarrival']);?>
                <div id="image_main" class="image_block">
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
                    <a href="<?=Url::to(['/admin/products/delete_image','id_change'=>$image->id,'id_product'=>$id_product])?>" class="btn btn_image btn-danger btn_delete" data-id_image="<?=$image->id?>" data-id_product="<?=$id_product?>">Delete</a>
                    <a href="<?=Url::to(['/admin/products/do_main_image','id_change'=>$image->id,'id_product'=>$id_product])?>" class="btn btn_image btn-success btn_mark" data-id_image="<?=$image->id?>" data-id_product="<?=$id_product?>">Do main</a>
                </div>
            <?php endif;?>
        </div>
    <?php endforeach;?>
