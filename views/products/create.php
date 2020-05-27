<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product app\models\Product */
///* @var $category app\models\Category */
/* @var $categories app\models\Category */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$listData=ArrayHelper::map($categories,'id','title');

?>

<div>
    <h1> <?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
    <?= $form->field($product, 'p_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'p_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'p_amount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'discount')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($product, 'c_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
    ); ?>
    <?= $form->field($product,'images')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Create',['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>

