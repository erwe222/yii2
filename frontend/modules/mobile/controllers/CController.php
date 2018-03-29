<?php
namespace frontend\modules\mobile\controllers;

use yii;
use frontend\models\LoginForm;
/**
 * Description of CController
 *
 * @author dell
 */
class CController extends \yii\web\Controller{
    
    public $enableCsrfValidation = false;
    
    public function init() {
        parent::init();
        
        //设置home路径
        Yii::$app->setHomeUrl('/mobile/index/index');
        
        //布局文件设置
        $this->layout = 'main';
        
        //用户登录变量
        Yii::$app->view->params['is_login'] = $this->is_Login();
    }
    
    /**
     * 判断用户是否登录
     */
    public function is_Login(){
        if(count($this->getUserInfo()) > 0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 获取用户登录信息
     */
    public function getUserInfo(){
        $model = new LoginForm();
        $info = $model->getUserSession();
        if(count($info) > 0){
            return $info;
        }
        return [];
    }
    
    /**
     * 获取用户登录ID 
     */
    public function getUserID(){
        if($this->is_Login()){
            $user_info = $this->getUserInfo();
            return $user_info['id'];
        }
        return 0;
    }

}
