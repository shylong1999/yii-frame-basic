<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $users app\models\User */

$this->title = 'Manage Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'name',
            [
                'attribute' => 'Role',
                'value' => function ($data) {
                    $roles = \Yii::$app->authManager->getRolesByUser($data->id);
                    if ($roles) {
                        return implode(', ', array_keys($roles));
                    } else {
                        return 'no roles';
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
