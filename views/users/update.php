<?php

use app\models\Role;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $user_role app\models\Role */
/* @var $roles app\models\Role */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Update Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$listData=ArrayHelper::map($roles,'item_name','item_name');
?>

<div>
    <h1> <?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin();?>
    <?= $form->field($user, 'username')->textInput(['maxlength' => true,'disabled' => true]) ?>
    <?= $form->field($user, 'name')->textInput(['maxlength' => true,'disabled' => true]) ?>
    <?= $form->field($user_role, 'item_name')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
    ); ?>


    <div class="form-group">
        <?= Html::submitButton('Update',['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

