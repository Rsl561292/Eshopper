<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Brands;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class BrandsController extends AppAdminController
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
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Brands::find(),
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);

        $this->setMeta('Adminka|List brands');
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brands model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->setMeta('Adminka|Detail brand');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Brands model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brands();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Brand "'.$model->name.'" successfully created!');
            $this->setMeta('Adminka|Detail brand');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Create new brand');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Brands model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Changes in brand number '.$model->id.' successfully saved!');
            $this->setMeta('Adminka|Detail brand');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Update brand');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Brands model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $rez=$model->deleteBrand();

        if($rez===(12)){
            Yii::$app->session->setFlash('error','Brand "'.$model->name.'" can not be deleted because products found in this brand!');
            $this->refresh();
        }elseif(!$rez){
            Yii::$app->session->setFlash('error','Brand "'.$model->name.'" can not be deleted because of technical problem!');
            $this->refresh();
        }else{
            Yii::$app->session->setFlash('success','Brand "'.$model->name.'" successfully deleted!');
        }

        $this->setMeta('Adminka|List brands');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Brands model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brands the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brands::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
