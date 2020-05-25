<?php


namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }
    public function rules()
    {
        return [
            [['title'],'required'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 6000],
        ];
    }
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'description' => 'Descrition',
//            'population' => 'Population',
        ];
    }

    public function getProducts(){
        return $this->hasMany(Product::className(),['id' => 'c_id']);
    }
}