<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
///* @var $data app\models\Order */
/* @var $form yii\widgets\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

\yii\web\YiiAsset::register($this);

?>

<h1><?= Html::encode($this->title) ?></h1>

<p>

</p>

<h1>Order Details</h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'p_name',
        'quantity',
        'date',
        'payment',

//        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
