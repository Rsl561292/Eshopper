<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order_items".
 *
 * @property string $id
 * @property string $order_id
 * @property string $product_id
 * @property string $name_product
 * @property double $price
 * @property integer $qty_item
 * @property double $sum_item
 */
class OrderItems extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    public function getOrders(){
        return$this->hasOne(Orders::className(),['id'=>'order_is']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'name_product', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'product_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name_product'], 'string', 'max' => 255],
            ['qty_item', 'validateOnZero'],
        ];
    }

    public function validateOnZero($attribute,$params)
    {
        if($attribute==0){
            $this->addError($attribute,'The field can not be zero ');
        }
    }

    public function saveAllField($id,$item,$order_id){
        $this->order_id=$order_id;
        $this->product_id=$id;
        $this->name_product=$item['name'];
        $this->price=$item['price'];
        $this->qty_item=$item['qty'];
        $this->sum_item=$item['sum'];
        if($this->save())
            return true;
        else
            return false;
    }

}
