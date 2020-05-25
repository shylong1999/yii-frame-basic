<?php


namespace app\controllers;


use app\models\Category;
use app\models\Product;
use yii\data\ActiveDataProvider;
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
        ];
    }
    public function actionIndex(){
        $categories = Category::find();
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
        $category = Category::findOne($id);
//        $category = new Category();
        if ($category->load(\Yii::$app->request->post()) && $category->save()){
            return $this->redirect(['/category/view', 'id' => $category->id]);
        }
        return $this->render('/categories/update', [
            'category' => $category,
        ]);
    }
    public function actionView($id){
        $category = Category::findOne($id);
        $products = Product::find()->asArray()->where('c_id=:id', [':id' => $id]);
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