<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AppAdminController
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()->with('category_parent'),
            'pagination'=>[
                'pageSize'=>10,
            ],/*
            'sort'=>[
                'defaultOrder'=>[
                    'name'=>SORT_ASC,
                ]
            ]*/
        ]);

        $this->setMeta('Adminka|List categories');
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->setMeta('Adminka|Detail category');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Category named "'.$model->name.'" successfully created!');
            $this->setMeta('Adminka|Detail category');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Create new category');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Changes in category number '.$model->id.' successfully saved!');
            $this->setMeta('Adminka|Detail category');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Update category');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $rez=$model->deleteCategory();

        if($rez===(12)){
            Yii::$app->session->setFlash('error','Category "'.$model->name.'" can not be deleted because products found in this category!');
            $this->refresh();
        }elseif(!$rez){
            Yii::$app->session->setFlash('error','Category "'.$model->name.'" can not be deleted because of technical problem!');
            $this->refresh();
        }else{
            Yii::$app->session->setFlash('success','Category "'.$model->name.'" successfully deleted!');
        }

        $this->setMeta('Adminka|List categories');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
