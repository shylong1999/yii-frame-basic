<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $products app\models\Product */
/* @var $order app\models\Order */
/* @var $order_detail app\models\OrderDetail */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create Order';
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$listData=ArrayHelper::map($products,'id','p_name');

?>

<div>
    <h1> <?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <?=
    $form->field($order_detail, 'product_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
    ); ?>
    <?= $form->field($order_detail, 'quantity')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Create',['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>

