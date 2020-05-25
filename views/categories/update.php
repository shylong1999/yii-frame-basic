<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $category app\models\Category */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => ['view', 'id' => $category->id]];

?>

<div>
    <h1> <?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin();?>
    <?= $form->field($category, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($category, 'description')->textarea(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Create',['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

