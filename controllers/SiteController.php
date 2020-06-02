<?php

namespace app\controllers;

use app\models\Country;
use app\models\EntryForm;
use app\models\RegisterForm;
use app\models\Role;
use app\models\UploadForm;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['manage-user'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('/product/index');
//        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            print_r(Yii::$app->user->identity->username);
//            die();
            return $this->goBack('/product/index');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = "Hello World!")
    {
        return $this->render('say', ['message' => $message]);
    }


    public function actionEntry()
    {
        $model = new EntryForm();

        $data = Country::find()->orderBy('name')->all();
        $country = Country::findOne('US');
//        echo $country->name;
        if ($model->load(Yii::$app->request->post())) {
//            $data = $model->load(Yii::$app->request->post());
//            echo $data->name;
//            print_r($country->name);
//            die();
//            print_r(Url::to(['country/index']));
//            die();
            return $this->render('entry-confirm', ['model' => $model, 'data' => $data]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionUpload()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                echo "post image success";
                $basePath = '/uploads/'.$model->imageFile->baseName . ".".$model->imageFile->extension;
                echo "<img src='$basePath'>";
                return;
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionCountry()
    {
        $query = Country::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('/country/index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $auth = \Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $auth->assign($userRole, $model->id);
            return $this->redirect('login');
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionManageUser()
    {
        if (Yii::$app->user->can('admin')) {
            $users = User::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $users,
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]);

            return $this->render('/users/index', [
                'users' => $users,
                'dataProvider' => $dataProvider,
            ]);
        } else return $this->redirect('manage-user');
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('admin')) {
            $user = User::findOne($id);
            $user_role = Role::findOne(['user_id' => $id]);
            $roles = Role::find()->all();

            if ($user_role->load(Yii::$app->request->post()) && $user_role->save()) {
                return $this->redirect('manage-user');
            }

            return $this->render('/users/update', [
                'user' => $user,
                'roles' => $roles,
                'user_role' => $user_role,
            ]);
        } else return $this->redirect('index');
    }

}
