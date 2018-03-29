<?php
namespace admin\controllers;
use yii\filters\AccessControl;

class AdminController extends CController{
    
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
            ]
        ];
    }
    
    /**
     * 商家个人信息
     */
    public function actionMyInfo(){
        return $this->render('my-info', $params =[] );
    }
}
