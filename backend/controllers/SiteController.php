<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;

use backend\models\Route;
use backend\models\Menu;
use backend\models\AuthItem;
/**
 * Site controller
 */
class SiteController extends CController
{

//     public function beforeAction($action)
//     {
//         echo '执行啦-》beforeAction';
//         return true;
//     }

    // public function behaviors()
    // {
    //     return [
    //         //附加行为（若果该控制器(控制器父类)定义了 beforeAction\afterAction\beforeSave\afterSave  则 myBehavior 中的 beforeAction\afterAction\beforeSave\afterSave 不会被调用）
    //         // 'myBehavior' => \backend\components\MyBehavior::className(),
    //         'as access' => [
    //             'class' => 'backend\components\AccessControl',
    //         ],
    //         'verbs' => [
    //             'class' => \yii\filters\VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
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
            'crop'=>[
                'class' => 'hyii2\avatar\CropAction',
                'config'=>[
                    'bigImageWidth' => '200',     //大图默认宽度
                    'bigImageHeight' => '200',    //大图默认高度
                    'middleImageWidth'=> '100',   //中图默认宽度
                    'middleImageHeight'=> '100',  //中图图默认高度
                    'smallImageWidth' => '50',    //小图默认宽度
                    'smallImageHeight' => '50',   //小图默认高度

                    //头像上传目录（注：目录前不能加"/"）
                    'uploadPath' => 'uploads/avatar',
                ]
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

        return $this->render('index');
    }

    public function actionTest2(){
        //获取自定的行为类
        $myBehavior = $this->getBehavior('myBehavior2');
        var_dump($myBehavior);
         return $this->render('test');
    }




    public function actionTest(){
        return $this->render('test');
//        echo encryptStr('jingrui_1hblsqt', 'E');
//        $options = ['class' => 'btn btn-default'];
//        $type = 'fail';
//        $type = 'success';
//        if ($type === 'success') {
//            Html::removeCssClass($options, 'btn-default');
//            Html::addCssClass($options, 'btn-success');
//        }
//
//        echo Html::tag('div', 'Pwede na', $options);

        // return $this->render('test');
    }
    
    public function actionIcon(){
        return $this->renderPartial('bootstrap-icon');
    }
    
    public function actionError(){
        dump('asfa');
    }
    
//    public function actionRaoyd(){
//        
//    }
    

}
