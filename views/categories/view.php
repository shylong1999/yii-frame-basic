<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $category app\models\Category */
/* @var $products app\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = $category->title;
$this->params['breadcrumbs'][] = ['label' => 'Category  ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Update', ['update', 'id' => $category->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $category->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $category,
    'attributes' => [
        'title',
        'description',
    ],
]) ?>

<h1>List products</h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'p_name',
        'p_price',
        'p_amount',

//        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
