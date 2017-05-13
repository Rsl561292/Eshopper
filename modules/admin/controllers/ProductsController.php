<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Products;
use app\models\Image;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends AppAdminController
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->with(['category','brands']),
            'pagination'=>[
                'pageSize'=>10,
            ],/*
            'sort'=>[
                'defaultOrder'=>[
                    'name'=>SORT_ASC,
                ]
            ]*/
        ]);

        $this->setMeta('Adminka|List products');
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->setMeta('Adminka|Detail product');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image=UploadedFile::getInstance($model,'image');
            if($model->image){
                $model->upload(true);
                unset($model->image);
            }

            //загрузка картинок
            $model->gallery_images=UploadedFile::getInstances($model,'gallery_images');
            //mas_print($model->gallery_images);
            if($model->gallery_images){
                $model->uploadGallery();
            }

            Yii::$app->session->setFlash('success','Product named "'.$model->name.'" successfully created!');
            $this->setMeta('Adminka|Detail product');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Create new product');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*
            $model->image=UploadedFile::getInstance($model,'image');
            if($model->image){
                $model->upload();
            }*/

            //загрузка картинок
            unset($model->image);//щоб вирішити помилку з галереєю -- не добавляло картинки
            $model->gallery_images=UploadedFile::getInstances($model,'gallery_images');
            if($model->gallery_images){
                $model->uploadGallery();
            }

            Yii::$app->session->setFlash('success','Changes in product with web id '.$model->id.' successfully saved!');
            $this->setMeta('Adminka|Detail product');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $this->setMeta('Adminka|Update product');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        if(empty($model)){
            Yii::$app->session->setFlash('error','The product with web id '.$id.' that you want to remove not found.');
        }else{
            if($model->deleteProductWithImage()){
                Yii::$app->session->setFlash('success','Product with web id '.$id.' successfully deleted!');
            }else{
                Yii::$app->session->setFlash('error','Error! Product with web id '.$id.' not deleted! Please try again.');
            }
        }

        $this->setMeta('Adminka|List products');
        return $this->redirect(['index']);
    }

    public function actionDo_main_image()
    {
        $id_change=Html::encode(Yii::$app->request->get('id_change'));
        $id_product=Html::encode(Yii::$app->request->get('id_product'));

        $model_product=$this->findModel($id_product);
        if(empty($model_product)){
            if(Yii::$app->request->isAjax){
                return false;
            }
            Yii::$app->session->setFlash('error','Error! The product that you edited not found.');
            $this->actionIndex();
        }else{
            $images=$model_product->getImages();
            foreach($images as $img){
                if($img->id == $id_change){
                    $model_product->setMainImage($img);//will set current image main

                    if(Yii::$app->request->isAjax){
                        $id_product=$model_product->id;
                        $images=$model_product->getImages();
                        $this->layout=false;
                        return $this->render('gallery_image',array('images'=>$images,'id_product'=>$id_product));
                    }else{
                        Yii::$app->session->setFlash('success','Success! Assign new main image be success and change saved in database site.');
                        $this->setMeta('Adminka|Update product');
                        return $this->render('update', [
                            'model' => $model_product,
                        ]);
                    }

                }
            }
            if(Yii::$app->request->isAjax){
                return false;
            }else{
                Yii::$app->session->setFlash('error','Error! The picture you wanted to do main is not found');
                $this->setMeta('Adminka|Update product');
                return $this->render('update', [
                    'model' => $model_product,
                ]);
            }
        }

    }

    public function actionDelete_image()
    {
        $id_change=Html::encode(Yii::$app->request->get('id_change'));
        $id_product=Html::encode(Yii::$app->request->get('id_product'));

        $model_product=$this->findModel($id_product);
        if(empty($model_product)){
            if(Yii::$app->request->isAjax){
                return false;
            }
            Yii::$app->session->setFlash('error','Error! The product that you edited not found.');
            $this->actionIndex();
        }else{
            $images=$model_product->getImages();
            foreach($images as $img){
                if($img->id == $id_change){
                    $model_product->removeImage($img);//will set current image main
                    $images=$model_product->getImages();
                    foreach($images as $img){
                        $model_product->setMainImage($img);
                        break;
                    }

                    if(Yii::$app->request->isAjax){
                        $id_product=$model_product->id;
                        $images=$model_product->getImages();
                        $this->layout=false;
                        return $this->render('gallery_image',array('images'=>$images,'id_product'=>$id_product));
                    }else{
                        Yii::$app->session->setFlash('success','Success! Image be successfully removed and change saved in database site.');
                        $this->setMeta('Adminka|Update product');
                        return $this->render('update', [
                            'model' => $model_product,
                        ]);
                    }

                }
            }
            if(Yii::$app->request->isAjax){
                return false;
            }else{
                Yii::$app->session->setFlash('error','Error! The picture you wanted delete not found');
                $this->setMeta('Adminka|Update product');
                return $this->render('update', [
                    'model' => $model_product,
                ]);
            }
        }

    }


    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
