<?php


namespace app\models;


use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;
    public function rules()
    {
        return [
          [['name','email'],'string'],
//          ['email','email'],
//        'name' => $this->name,

        ];
    }
}