<?php


namespace app\models;


use yii\db\ActiveRecord;

class Order extends ActiveRecord
{

    public static function tableName()
    {
        return 'orders';
    }
    public function rules()
    {
        return [
            [['user_id','date','status'],'required'],
            [['date'],'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }
    public function getOrderDetails(){
        return $this->hasMany(OrderDetail::className(),['order_id'=> 'id']);
    }
}