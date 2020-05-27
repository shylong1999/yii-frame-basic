<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
//    public $id;
//    public $username;
//    public $password;
//    public $name;
//    public $email;
//    public $age;
//    public $authKey;
//    public $accessToken;

    public $role;

    public static function tableName()
    {
        return 'users';
    }

//    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
//            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
//    ];


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'password','confirmPassword', 'email','age'], 'required'],
            ['email', 'email'],
            [['username','email'], 'unique'],
            ['age', 'integer'],
        ];
    }
    public static function findIdentity($id)
    {
//        $users = User::findOne($id);
//        return isset($users[$id]) ? ($users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        $users = User::find()->asArray()->all();
//
//        foreach ($users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {

        $identity = User::findOne(['username' => $username]);
        return new static($identity);
//        return static::findOne(['username' => $username]);
//        print_r($user);
//        die();
//        return $user;
//        $users = User::find()->asArray()->all();
////        print_r($users);
////        die();
//        foreach ($users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }
//
//        return null;

    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authKey = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
//    public function
}
