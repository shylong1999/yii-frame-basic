<?php


namespace app\controllers;


use app\models\Category;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CategoryController extends Controller
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
                'only' => ['logout'],
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
                ],
            ],
        ];
    }
    public function actionIndex(){
        $categories = Category::find();
	print($categories);
        print_r($categories);
        $dataProvider = new ActiveDataProvider([
            'query' => $categories,
        ]);
        return $this->render('/categories/index', ['dataProvider' => $dataProvider,'categories' => $categories]);
    }
    public function actionCreate(){
        $category = new Category();
        if ($category->load(\Yii::$app->request->post()) && $category->save()){
            return $this->redirect(['/category/view', 'id' => $category->id]);
        }
        return $this->render('/categories/create', [
            'category' => $category,
        ]);
    }
    public function actionUpdate($id){
        if (\Yii::$app->user->can('updatePost')) {
            $category = Category::findOne($id);
            if ($category->load(\Yii::$app->request->post()) && $category->save()){
                return $this->redirect(['/category/view', 'id' => $category->id]);
            }
            return $this->render('/categories/update', [
                'category' => $category,
            ]);
        }
        else
            return $this->redirect(['category/index']);

    }
    public function actionView($id){
        $category = Category::findOne($id);
//        $products = Product::find()->asArray()->where('c_id=:id', [':id' => $id]);
        $products = $category->getProducts();
        $dataProvider = new ActiveDataProvider([
            'query' => $products,
        ]);
        return $this->render('/categories/view', [
            'category' => $category,
            'products' => $products,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $category = Category::findOne($id);
        $category->delete();
        return $this->redirect(['/category/index']);
    }

    public function actionProduct(){
//        $category = Category::findOne(['id' => 1]);
//        $products = $category->getProducts();
//
//        return $products;
        $products = Product::find()->asArray()->where('c_id=:id', [':id' => 3])->all();
        print_r($products);
        die();
    }

}
