<?php
namespace admin\controllers;
use Yii;
use yii\filters\AccessControl;

class ConsoleController extends CController{

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                 'class' => \yii\filters\VerbFilter::className(),
                 'actions' => [
                     'get-post-data-menu' => ['POST'],
                 ],
            ]
        ];
    }
    
    public function actionSystemInfo(){
        return $this->render('system-info', $params = []);
    }
}
