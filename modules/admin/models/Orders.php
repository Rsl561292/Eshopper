<?php

namespace app\modules\admin\models;

use Yii;

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
class Orders extends \yii\db\ActiveRecord
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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'qty', 'sum', 'name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty'], 'integer'],
            [['sum', 'shipping_cost', 'eco_tax'], 'number'],
            [['status'], 'string'],
            [['name', 'email', 'address'], 'string', 'max' => 255],
            ['notes','string'],
            [['phone'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Order ID',
            'created_at' => 'Date created',
            'updated_at' => 'Date updated',
            'qty' => 'Number unit product',
            'sum' => 'Sum order',
            'shipping_cost' => 'Shipping Cost',
            'eco_tax' => 'Eco tax',
            'status' => 'Status',
            'name' => 'Name customer',
            'email' => 'Email customer',
            'phone' => 'Phone customer',
            'address' => 'Address customer',
            'notes' => 'Notes from order',
        ];
    }

    public function deleteOrder($id){
        $transaction=Yii::$app->db->beginTransaction();
        if(Orders::delete($id)){
            if(OrderItems::deleteAll(['order_id'=>$id])){
                $transaction->commit();
                return true;
            }else{
                $transaction->rollBack();
                return false;
            }
        }else{
            $transaction->rollBack();
            return false;
        }
    }
}
