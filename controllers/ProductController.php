<?php


namespace app\controllers;


use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProductController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = new \yii\db\Query;
        $products = $query->from(['p' => 'products'])
            ->select(['p.id', 'p.p_name', 'p.p_price', 'p.p_amount', 'p.discount', 'c.title'])
            ->innerJoin(['c' => 'categories'], 'c.id = p.c_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('/products/index', [
            'products' => $products,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $categories = Category::find()->asArray()->all();
        $product = new Product();
        if ($product->load(\Yii::$app->request->post()) && $product->validate()) {

            $product->save();
//            return $this->redirect('index');
            return $this->redirect(['/product/view', 'id' => $product->id]);
        }

        return $this->render('/products/create', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function actionUpdate($id)
    {
        $product = Product::findOne($id);
        if ($product->load(Yii::$app->request->post()) && $product->save()) {

            return $this->redirect('index');
        }
        $categories = Category::find()->asArray()->all();
        return $this->render('/products/update', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function actionView($id)
    {
        $product = Product::findOne($id);

        return $this->render('/products/view', [
            'product' => $product,
        ]);
    }
}