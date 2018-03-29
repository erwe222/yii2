<?php
namespace admin\controllers;
use Yii;
use common\models\SellerApiClass;
use yii\filters\AccessControl;

class ClassifyController extends CController{
    
    public $defaultAction = 'menu';
    
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
    
    public function actionMenu(){
        return $this->render('menu');
    }
    
    /**
     * 获取分类列表
     */
    public function actionGetPostDataMenu(){
        $res = SellerApiClass::getInstance()->getSellerList();
        $array = array('code'=>0,'msg'=>'','count'=>$res['data']['toatl_num'],'data'=>$res['data']['infos']);
        return $this->asJson($array);
    }
}
