<?php


namespace app\models;


use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    public static function tableName(){
        return 'auth_assignment';
    }

    public function rules()
    {
        return [
          [['item_name','user_id'], 'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',

//            'population' => 'Population',
        ];
    }

}