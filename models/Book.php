<?php


namespace app\models;
use Yii;

use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return 'books';
    }
    public function rules()
    {
        return [
            [['name','author'],'required'],
            [['category_id'],'integer'],
            [['author'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'author' => 'Author',
//            'population' => 'Population',
        ];
    }

}