<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Orders;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends AppAdminController
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Orders::find(),
            'pagination'=>[
              'pageSize'=>10,
            ],
            'sort'=>[
                'defaultOrder'=>[
                    'status'=>SORT_ASC,
                    'created_at'=>SORT_ASC,
                    'updated_at'=>SORT_ASC,
                    'sum'=>SORT_ASC,
                ]
            ],
        ]);

        $this->setMeta('Adminka|List orders');
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->setMeta('Adminka|Detail order');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->setMeta('Adminka|Detail order');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Create order');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Order successfully edited');
            $this->setMeta('Adminka|Detail order');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Update order');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $order=new Orders();
        if($order->deleteOrder($id)){
            Yii::$app->session->setFlash('success','Order number '.$id.' successfully deleted');
        }else{
            Yii::$app->session->setFlash('error','Error deleting! Order number '.$id.' not deleted');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
