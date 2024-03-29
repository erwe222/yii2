<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;

class IndexController extends CController
{

    #访问控制过滤器ACF讲解
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => \yii\filters\AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     // 当前rule将会针对这里设置的actions起作用，如果actions不设置，默认就是当前控制器的所有操作
    //                     // 'actions' => ['view', 'create', 'update', 'delete', 'signup'],
    //                     // 设置actions的操作是允许访问还是拒绝访问
    //                     'allow' => true,
    //                     // @ 当前规则针对认证过的用户; ? 所有方可均可访问
    //                     'roles' => ['@'],
    //                 ],
    //                 // [
    //                 //     'actions' => ['index'],
    //                 //     'allow' => true,
    //                 //     // 设置只允许操作的action
    //                 //     'verbs' => ['POST'],
    //                 // ],
                    

    //                 // [    #假设 update 操作只有用户 test1 可以访问，其他用户不可以访问
    //                 //     'actions' => ['update'],
    //                 //     // 自定义一个规则，返回true表示满足该规则，可以访问，false表示不满足规则，也就不可以访问actions里面的操作啦
    //                 //     'matchCallback' => function ($rule, $action) {
    //                 //         return Yii::$app->user->id == 1 ? true : false;
    //                 //     },
    //                 //     'allow' => true,
    //                 // ],
    //             ],
    //         ],
    //     ];
    // }

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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['login/login']);
        }
        return $this->render('index');
    }

}
