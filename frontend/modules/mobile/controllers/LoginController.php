<?php
namespace frontend\modules\mobile\controllers;
use yii;
use frontend\modules\mobile\controllers\CController;
use frontend\models\LoginForm;
use frontend\models\SignupForm;
use api\models\UserApiClass;
use common\components\instantchat\WebSocket;

/**
 * Description of LoginController
 *
 * @author dell
 */
class LoginController extends CController{
    
    /**
     * 控制器权限控制
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        if($this->is_Login()){
            $this->redirect('/mobile/index/index');
        }
        
        return true;
    }
    
    /**
     * 用户登录页面
     */
    public function actionSignin(){
        return $this->render('signin');
    }
    
    /**
     * 用户注册页面
     */
    public function actionRegister(){
        return $this->render('register');
    }
    
    /**
     * 用户找回密码页面
     */
    public function actionFindPwd(){
        return $this->render('findpwd');
    }
    
    /**
     * 用户退出登录操作
     */
    public function actionLogout()
    {
        $model = new LoginForm();
        $model->SignOut();
        return $this->goHome();
    }
    
    /**
     * ajax登录操作
     */
    public function actionPostSignin(){
        $post = Yii::$app->request->post();
        $model = new LoginForm();
        $model->load(['params' => $post], 'params');
        $res = $model->ajaxLogin();
        return json_encode($res);
    }
    
    /**
     * ajax注册操作
     */
    public function actionPostRegister(){
        $arrJson['errCode'] = 301;
        $arrJson['errMsg'] = '添加用户失败';
        $model = new SignupForm();
        $data = Yii::$app->request->post();
        if($model->load(['params' => $data], 'params')){
//            $res = UserApiClass::getInstance()->checkSmsCode(['mobile'=>'1276816843@qq.com','send_type'=>1,'code'=>isset($data['code'])?$data['code']:'000000']);
            if ($user = $model->signup()) {
                $login_model = new LoginForm();
                $login_model->setUserSession($user->attributes);
                $arrJson['errCode'] = 200;
                $arrJson['errMsg'] = '添加用户成功';
            }else{
                if($model->errorCode == 1){
                    $arrJson['errCode'] = 302;
                    $arrJson['errMsg'] = '用户已存在';
                }
            }
        }
        return json_encode($arrJson);
    }

    /**
     * 发送短信验证码
     */
    public function actionSendCode(){
        $post = Yii::$app->request->post();
        if(isset($post['username'])){
            $res = UserApiClass::getInstance()->checkUser(['username'=>$post['username']]);
            if(!$res){
                $res2 = UserApiClass::getInstance()->sendSmsCode(
                    [
                        'send_type' =>  1,
                        'type'      =>  1,
                        'mobile'    =>  $post['username'],
                    ]
                );
                if($res2){
                    $arrJson['errCode'] = 200;
                    $arrJson['errMsg'] = '发送成功...';
                }else{
                    $arrJson['errCode'] = 404;
                    $arrJson['errMsg'] = '短信发送失败...';
                }
            }else{
                $arrJson['errCode'] = 405;
                $arrJson['errMsg'] = '用户已存在...';
            }
        }
        return json_encode($arrJson);
    }

    public function actionJsSign(){
        return $this->render('jssign');
    }

    public function actionSaveSign(){
        define('UPLOAD_DIR', \Yii::$app->basePath.'\web\uploadSign/');
        $img = $_POST['data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        print $success ? $file : 'Unable to save the file.';
    }
}