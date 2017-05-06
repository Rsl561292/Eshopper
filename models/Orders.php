<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Transaction;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $qty
 * @property double $sum
 * @property double $shipping_cost
 * @property double $eco_tax
 * @property string $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $notes
 */
class Orders extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function getOrderItems(){
        return $this->hasMany(OrderItems::className(),['order_id'=>'id']);
    }

    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                 'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            ['qty','validateOnZero'],
            [['sum','shipping_cost','eco_tax'], 'number'],
            [['status'], 'boolean'],
            [['name', 'email', 'address'], 'string', 'max' => 255],
            ['notes','string'],
            [['phone'], 'string', 'max' => 16],
            ['qty','validateOnZero'],
        ];
    }

    public function validateOnZero($attribute,$params)
    {
        if($attribute==0){
            $this->addError($attribute,'The field can not be zero ');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'notes' => 'Notes for order',
        ];
    }

    public function saveOrderAll($mas,$qty,$sum){
        $this->qty=$qty;
        $this->sum=$sum;
        $this->shipping_cost=0.0;
        $this->eco_tax=2.0;
        $transaction=Orders::getDb()->beginTransaction();
        //mas_print($this);
        if($this->save()){
            foreach($mas as $id=>$item){
                $order_item=new OrderItems();
                if(!$order_item->saveAllField($id,$item,$this->id)){
                    //OrderItems::deleteAll(['order_id'=>$this->id]);
                    //$this->delete();
                    $transaction->rollBack();
                    return false;
                }
            }
            $transaction->commit();
            return true;
        }else {
            $transaction->rollBack();
            return false;
        }
    }
}
