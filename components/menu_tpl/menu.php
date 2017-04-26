<li>
    <?php if(isset($category['childs'])):?>
        <a href="#" class="title_a">
            <?=$category['name']?>
                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        </a>
            <ul>
                <?=$this->getMenuHtml($category['childs'])?>
            </ul>
    <?php endif;?>

    <?php if(!isset($category['childs'])):?>
        <a href="<?=\yii\helpers\Url::to(['site/view_category_products','id_category'=>$category['id']])?>" class="title_a">
            <?=$category['name']?>
        </a>
    <?php endif;?>
</li>