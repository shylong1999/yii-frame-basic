<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $book app\models\Book */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create book';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div>
    <h1> <?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin();?>
    <?= $form->field($book, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($book, 'author')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Create',['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

