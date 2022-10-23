<?php


namespace app\controllers;


use app\models\Book;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
class BookController extends Controller
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
    public function actionIndex()
    {
        $books = Book::find();
	print("ALO");
        $dataProvider = new ActiveDataProvider([
            'query' => $books,
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider,'book' => $books]);
    }

    public function actionCreate()
    {
        $book = new Book();
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(['view', 'id' => $book->id]);
        }
        return $this->render('create', [
            'book' => $book,
        ]);
    }

    public function actionUpdate($id)
    {
        $book = Book::findOne($id);
	print($book);
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(['view', 'id' => $book->id]);
        }
        return $this->render('update', [
            'book' => $book
        ]);
    }

    public function actionView($id)
    {
        $book = Book::findOne($id);
        return $this->render('view', [
            'book' => $book,
        ]);
    }
}
