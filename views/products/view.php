<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $product app\models\Product */
/* @var $form yii\widgets\ActiveForm */
$this->title = $product->p_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Update', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $product->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $product,
    'attributes' => [
        'p_name',
        'p_price',
        'p_amount',
        'discount',
        [
            'attribute' => 'images',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img(\Yii::$app->request->BaseUrl . '/uploads/' . $data->images, ['width' => 100,'height' => 100]);
            },
        ],
    ],
]) ?>


