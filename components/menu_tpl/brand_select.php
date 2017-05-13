<?php foreach($mas_li as $item_li):?>
    <option value="<?=$item_li['id']?>"
        <?php if($item_li['id']==$this->model->brand_id)echo 'selected';?> >
        <?=$item_li['name']?>
    </option>
<?php endforeach;?>
