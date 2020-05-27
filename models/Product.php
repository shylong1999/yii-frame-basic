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
            [['images'],'file','skipOnEmpty' => false, 'extensions' => 'png,jpg']
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
            'images' => 'Images',
//            'population' => 'Population',
        ];
    }
    public function upload(){
        if ($this->validate()){

            $this->images->saveAs('uploads/'.$this->images->baseName . '.'.$this->images->extension);
//            $path = $this->images->saveAs('uploads/'.$this->images->baseName . '.'.$this->images->extension);
//            $model = new Product();
//            $model->images = $path;
//            $model->save();
            return true;
        }else return false;
    }

    public function getCategories(){
        return $this->hasOne(Category::className(),['id' => 'c_id']);
    }
}