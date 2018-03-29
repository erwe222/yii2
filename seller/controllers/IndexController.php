<?php
namespace seller\controllers;
use Yii;
use api\models\SellerApiClass;
use yii\filters\AccessControl;

class IndexController extends CController
{
    
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        if(!$this->isLogin()){
            return $this->redirect('login/login');
        }
        return $this->render('index');
    }
}
