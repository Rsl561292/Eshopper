<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 12.04.2017
 * Time: 17:35
 */

namespace app\controllers;
Use yii\web\Controller;


class AppController extends Controller
{
    protected function setMeta($title=null,$keywords=null,$description=null){
        $this->view->title=$title;
        $this->view->registerMetaTag(['name'=>'keywords','content'=>"$keywords"]);
        $this->view->registerMetaTag(['name'=>'$description','content'=>"$description"]);
    }

}