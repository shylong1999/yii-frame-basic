<?php


namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class RegisterForm extends ActiveRecord
{
//    public $username;
//    public $password;
    public $confirmPassword;
//    public $name;
//    public $age;
//    public $email;
    public $verifyCode;


    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username', 'name', 'password','confirmPassword', 'email','age', 'verifyCode'], 'required'],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password'],
            ['email', 'email'],
            [['username','email'], 'unique'],
            ['age', 'integer'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }


}