<?php
/**
 * Created by PhpStorm.
 * User: AdminRus
 * Date: 01.05.2017
 * Time: 12:38
 */

namespace app\modules\admin\controllers;
use yii\web\Controller;

class AppAdminController extends Controller
{

    protected function setMeta($title=null,$keywords=null,$description=null){
        $this->view->title=$title;
        $this->view->registerMetaTag(['name'=>'keywords','content'=>"$keywords"]);
        $this->view->registerMetaTag(['name'=>'$description','content'=>"$description"]);
    }
}