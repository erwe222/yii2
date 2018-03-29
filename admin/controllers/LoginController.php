<?php
namespace admin\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\SellerApiClass;
use common\models\AdminApiClass;



/**
 * Site controller
 */
class LoginController extends \admin\controllers\CController
{

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

        if($this->isLogin()){
            return $this->redirect('/');
        }

        return $this->renderPartial('loginnAndregister');
    }
    
    /**
     * 登录控制器
     */
    public function actionPostLogin(){
        $username = Yii::$app->request->post('username','');
        $pwd = Yii::$app->request->post('password','');
        $rememberMe = Yii::$app->request->post('rememberme','yes');
        $code = Yii::$app->request->post('code','');
        if(!$this->createAction('captcha')->validate($code, false)){
            return $this->asJson($this->returnData(403, [], '验证码输入错误'));
        }

        $res = AdminApiClass::getInstance()->checkAdminLogin(['username'=>$username,'password'=>$pwd]);
        if($res['res']){
            $is_true = ($rememberMe == 'yes')? true : false;
            Yii::$app->user->login($res['data'], $is_true ? 3600 * 24 * 30 : 0);
            $res['data'] = [];
        }

        return $this->asJson($res);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->asJson($this->returnData(200,[] ,'',true));
    }
    
    /**
     * 注册控制器
     */
    public function actionPostRegister(){
        $username = Yii::$app->request->post('username','');
        $pwd = Yii::$app->request->post('password','');
        $code = Yii::$app->request->post('code','');
        $res = SellerApiClass::getInstance()->setSellerReg(['mobile'=>$username,'password'=>$pwd,'code'=>$code]);
        
        return $this->asJson($res);
    }
    
    /**
     * 发送注册验证码
     */
    public function actionSendRegCode(){
        $username = Yii::$app->request->post('username','');
        if(empty($username)){
            return $this->asJson($this->returnData(302,[],'手机号不能为空'));
        }

        $result = SellerApiClass::getInstance()->checkSeller(['username'=>$username]);
        if($result['res']){
            return $this->asJson($this->returnData(303,[],'手机号已被使用'));
        }

        $res = SellerApiClass::getInstance()->sendSmsCode(['mobile'=>$username,'type'=>4,'send_type'=>1]);

        if($res['code'] == 302){
            return $this->asJson($this->returnData(304,[],$res['message']));
        }else if($res['code'] == 200){
            return $this->asJson($this->returnData(200,[],$res['message'],true));
        }
    }
}
