<?php

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\data\Pagination;
use yii\filters\AccessControl;
use app\controllers\AppController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Category;
use app\models\Products;
use app\models\Brands;
use yii\helpers\Html;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;


class SiteController extends AppController
{
    public $layout="main";
    /**
     * @inheritdoc
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
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction', //app\controllers\action\MyerrorAction
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
        $request=Products::find()->where(['hit'=>'1']);

        $pages=new Pagination([
            'totalCount' => $request->count(),
            'pageSize'=>9,
            'forcePageParam'=>false,
            'pageSizeParam'=>false,
        ]);
        $hit_mas=$request->offset($pages->offset)->limit($pages->limit)->all();
        //mas_print($hit_mas);
        $rec_products=Products::find()->where(['recommended'=>'1'])->all();
        $this->setMeta('E-Shoper');
        return $this->render('index',compact('hit_mas','pages','rec_products'));
    }

    /**
     * Output to screen goods category.
     *
     * @return string
     */
    public function actionView_category_products()
    {
        $id=Yii::$app->request->get('id_category');
        $category=Category::findOne($id);
        if(empty($category)){
            throw new HttpException(404,'Selection of the category does not exist!');
        }


        $request=Products::find()->where(['category_id'=>$id]);
        $pages=new Pagination([
                            'totalCount' => $request->count(),
                            'pageSize'=>9,
                            'forcePageParam'=>false,
                            'pageSizeParam'=>false,
        ]);
        $productss=$request->offset($pages->offset)->limit($pages->limit)->all();

        //mas_print($productss);
        $count_record=$request->count();//передача кількості знайдених товарів
        $this->setMeta('E-Shoper|Category: '.$category->name,$category->keywords,$category->description);
        return $this->render('view_category_products',compact('productss','pages','count_record', 'category'));
    }

    public function actionView_brand_products()
    {
        $id=Yii::$app->request->get('id_brand');
        $brand=Brands::findOne($id);
        if(empty($brand)){
            throw new HttpException(404,'Selection of the brand does not exist!');
        }

        $request=Products::find()->where(['brand_id'=>$id]);
        $pages=new Pagination([
            'totalCount' => $request->count(),
            'pageSize'=>9,
            'forcePageParam'=>false,
            'pageSizeParam'=>false,
        ]);
        $productss=$request->offset($pages->offset)->limit($pages->limit)->all();

        $count_record=$request->count();//передача кількості знайдених товарів
        $this->setMeta('E-Shoper|Brand: '.$brand->name,$brand->keywords,$brand->description);
        return $this->render('view_brand_products',compact('productss','pages','count_record', 'brand'));
    }

    public function actionSearch()
    {
        $this->setMeta('E-Shoper|Search result');

        $search_query=trim(Html::encode(Yii::$app->request->get('search_query')));
        if(empty($search_query)){
            return $this->render('search',compact('search_query'));
        }

        $request=Products::find()->where(['like','name',$search_query]);

        $pages=new Pagination([
            'totalCount' => $request->count(),
            'pageSize'=>9,
            'forcePageParam'=>false,
            'pageSizeParam'=>false,
        ]);
        $productss=$request->offset($pages->offset)->limit($pages->limit)->all();

        $count_record=$request->count();//передача кількості знайдених товарів
        return $this->render('search',compact('productss','pages','count_record', 'search_query'));
    }

    /**
     * Output to screen goods category.
     *
     * @return string
     */
    public function actionView_all_products()
    {
        $request=Products::find();

        $pages=new Pagination([
            'totalCount' => $request->count(),
            'pageSize'=>9,
            'forcePageParam'=>false,
            'pageSizeParam'=>false,
        ]);
        $productss=$request->offset($pages->offset)->limit($pages->limit)->all();
/*
        $pages = new ActiveDataProvider([
            'query' => $request,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $productss=$pages->getModels();*/
        $count_record=$request->count();//передача кількості знайдених товарів
        $this->setMeta('E-Shoper|All products');
        return $this->render('view_all_products',compact('productss','pages','count_record'));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->contact(Yii::$app->params['siteEmail'])){
                Yii::$app->session->setFlash('contact_success','Your letter sent to the site managers');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('contact_error','You make a mistake in filling out forms');
                return $this->refresh();
            }
        }
        return $this->render('contact', compact('model'));
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

    /** Errors
     * @return string

    public function actionError()
    {

        $this->layout = '//error';

        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        switch ($exception->statusCode) {
            case 404:
                $code = $exception->statusCode;
                $name = $exception->getName();
                $message = $exception->getMessage();
                $view = '../errors/404';
                break;
            default:
                $view = '../errors/default';
                if ($exception instanceof HttpException) {
                    $code = $exception->statusCode;
                } else {
                    $code = $exception->getCode();
                }
                if ($exception instanceof Exception) {
                    $name = $exception->getName();
                } else {
                    $name = Yii::t('yii', 'Error');
                }
                if ($code) {
                    $name .= " (#$code)";
                }

                if ($exception instanceof UserException) {
                    $message = $exception->getMessage();
                } else {
                    $message = Yii::t('yii', 'An internal server error occurred.');
                }
        }


        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render($view, [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }*/
}
