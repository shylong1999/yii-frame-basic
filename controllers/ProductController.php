<?php


namespace app\controllers;


use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProductController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = new \yii\db\Query;
//        $products = $query->from(['p' => 'products'])
//            ->select(['p.id', 'p.p_name', 'p.p_price', 'p.p_amount', 'p.discount', 'c.title'])
//            ->innerJoin(['c' => 'categories'], 'c.id = p.c_id');
        $products = Product::find();
        $products->joinWith('categories');
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
        if ($product->load(\Yii::$app->request->post())) {
            $product->images = UploadedFile::getInstance($product, 'images');
            $product->save();
            if ($product->upload()) {
                return $this->redirect(['/product/view', 'id' => $product->id]);
            }

        }

        return $this->render('/products/create', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('admin')) {
            $product = Product::findOne($id);
            if ($product->load(Yii::$app->request->post())) {
                $product->images = UploadedFile::getInstance($product, 'images');
                $product->save();
                if ($product->upload()) {
                    return $this->redirect('index');
                }

            }
            $categories = Category::find()->asArray()->all();
            return $this->render('/products/update', [
                'product' => $product,
                'categories' => $categories,
            ]);
        }
        else return $this->redirect('product/index');
    }

    public function actionView($id)
    {
        $product = Product::findOne($id);

        return $this->render('/products/view', [
            'product' => $product,
        ]);
    }
    public function actionDelete($id)
    {
        $product = Product::findOne($id);
        $product->delete();
        return $this->redirect(['/product/index']);
    }
}