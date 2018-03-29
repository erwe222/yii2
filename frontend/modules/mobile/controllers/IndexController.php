<?php

namespace frontend\modules\mobile\controllers;
use frontend\modules\mobile\controllers\CController;
use yii;

/**
 * 主页
 * @author dell
 */
class IndexController extends CController
{

    /**
     * 手机端首页
     */
    public function actionIndex(){
        return $this->render('index');
    }
}
