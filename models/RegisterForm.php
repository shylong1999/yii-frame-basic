<?php


namespace app\models;


use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $email;
    public $verifyCode;

    public function rules()
    {
        return [
          [['username','name','password','email','verifyCode'],'required'],
          ['email','email']
        ];
    }

}