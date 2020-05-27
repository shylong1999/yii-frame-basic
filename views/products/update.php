<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product app\models\Product */
/* @var $categories app\models\Category */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Products';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => $product->p_name, 'url' => ['view', 'id' => $product->id]];
$listData=ArrayHelper::map($categories,'id','title');
?>

<div>
    <h1> <?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin();?>
    <?= $form->field($product, 'p_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'p_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'p_amount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'discount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'c_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
    ); ?>
    <?= $form->field($product,'images')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update',['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

