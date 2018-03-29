<?php
namespace seller\controllers;
use Yii;

class SiteController extends CController{

    public function actionError(){
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if($this->isLogin()){
                return $this->render('error', ['exception' => $exception]);
            }else{
                return $this->renderPartial('error', ['exception' => $exception]);
            }
        }
    }
}
