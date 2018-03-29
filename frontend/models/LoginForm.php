<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\captcha\Captcha;
use frontend\models\User;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            #['verifyCode', 'captcha', 'message'=>'验证码错误...', 'captchaAction'=>'/login/captcha'],//指定模块、控制器
        ];
    }

        /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '登录名',
            'password' => '密码',
            'verifyCode' => 'Verification Code',
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if(!$user){
                $this->addError('username', '用户名不存在...');
            }else if (!$user->validatePassword($this->password)) {
                $this->addError($attribute, '输入密码错误...');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
    
    /**
     * ajax登录
     */
    public function ajaxLogin(){
        $userInfo = $this->getUser();
        //code:[200登录成功，201用户不存在，202用户密码错误，203用户锁定]
        $arr = ['code'=>200,'message'=>'','data'=>[]];
        if($userInfo){
            if($userInfo->validatePassword($this->password)){
                $this->setUserSession($userInfo->attributes);
                $arr['data'] = [];
            }else{
                $arr['code'] = 202;
                $arr['message'] = '登录密码填写错误';
            }
        }else{
            $arr['code'] = 201;
            $arr['message'] = '当前用户不存在';
        }
        return $arr;
    }
    
    /**
     * 设置用户的登录信息
     */
    public function setUserSession($userInfo){
        Yii::$app->session['user_info'] = json_encode($userInfo);
    }
    
    public function getUserSession(){
        return json_decode(Yii::$app->session['user_info'],true);
    }
    
    /**
     * 用户退出登录操作
     */
    public function SignOut(){
        Yii::$app->session['user_info'] = null;
    }
    
}
