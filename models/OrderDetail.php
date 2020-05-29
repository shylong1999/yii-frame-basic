<?php


namespace app\models;


use yii\db\ActiveRecord;

class OrderDetail extends ActiveRecord
{
    public static function tableName()
    {
        return 'orderdetails';
    }
    public function rules()
    {
        return [
            [['order_id','product_id','quantity'],'required'],
        ];
    }
    public function getOrders(){
        return $this->hasOne(Order::className(),['id'=> 'order_id']);
    }
}