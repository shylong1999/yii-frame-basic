<?php


namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
//    public $primaryKey = 'id';
    public static function tableName()
    {
        return 'products';
    }
    public function rules()
    {
        return [
            [['p_name','p_price','p_amount'],'required'],
            [['p_name'], 'string', 'max' => 255],
            [['p_price'], 'integer', 'max' => 255],
            [['p_amount'], 'integer', 'max' => 255],
            [['discount'], 'integer', 'max' => 255],
            [['c_id'], 'integer', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'p_name' => 'Product Name',
            'p_price' => 'Price',
            'p_amount' => 'Amount',
            'discount' => 'Discount(%)',
            'c_id' => 'Category Name',
//            'population' => 'Population',
        ];
    }

    public function getCategories(){
        return $this->hasOne(Category::className(),['c_id' => 'id']);
    }
}