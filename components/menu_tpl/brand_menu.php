<?php foreach($mas_li as $item_li):?>
    <li><a href="<?=\yii\helpers\Url::to(['site/view_brand_products','id_brand'=>$item_li['id']])?>">
            <?=$item_li['name']?></a>
    </li>
<?php endforeach;?>
