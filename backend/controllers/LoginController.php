<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use frontend\models\ContactForm;
use backend\models\Admin;

/**
 * Site controller
 */
class LoginController extends Controller
{

    public $enableCsrfValidation = false;
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0x000000,//背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height'=>30,//高度
                'width' => 80,  //宽度  
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>4,        //设置字符偏移量 有效果
            ],
        ];
    }

    
    
    
    
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            //必须用render，否则不能刷新验证码，因为不能调用框架的js/jquery代码
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 后台ajax登录页面
     */
    public function actionAjaxLogin(){
        $arrJson = ['errCode' => 301,'errMsg'  => '该用户不存在...'];
        $post = Yii::$app->request->post();
        $model = new LoginForm();
        $model->load(['params' => $post], 'params');
        $user = $model->getUser();
        if($user){
           if($user->validatePassword($model->password)){
               $res = Yii::$app->user->login($user, $model->rememberMe ? 3600 * 24 * 30 : 0);
               $arrJson = ['errCode' => 200,'errMsg'  => '登录成功...'];
           }else{
               $arrJson = ['errCode' => 302,'errMsg'  => '用户密码输入错误...'];
           }
        }
        return json_encode($arrJson);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
