<?php
namespace app\components;
use yii\base\BaseObject;
use yii\base\Component;
class MyClass extends BaseObject
{
    private $_lable;

    /**
     * @return mixed
     */
    public function getLable()
    {
        return $this->_lable;
    }

    /**
     * @param mixed $lable
     */
    public function setLable($lable)
    {
        $this->_lable = trim($lable);
    }


}