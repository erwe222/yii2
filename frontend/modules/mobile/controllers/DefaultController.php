<?php

namespace frontend\modules\mobile\controllers;

use yii\web\Controller;

/**
 * Default controller for the `mobile` module
 */
class DefaultController extends Controller
{
    //布局文件
    public $layout = 'main';
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
