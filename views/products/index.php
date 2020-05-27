<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    /* @var $products app\models\Product */

    $this->title = 'Products';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'p_name',
            [
                'attribute' => 'title',
                'value' => 'categories.title',
            ],

            'p_price',
            'p_amount',
            'discount',
            [
                'attribute' => 'images',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(\Yii::$app->request->BaseUrl . '/uploads/' . $data->images, ['width' => 100]);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
