<?php
namespace seller\controllers;
use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
* 
*/
class CController extends Controller {

    public $enableCsrfValidation = false;

    // 访问控制器前进行权限验证
    public function beforeAction($action){
        // // 主控制器验证
        if ( ! parent::beforeAction($action)) {return false;}
        
        if($action->controller->id != 'login' && !$this->isLogin()){
            return $this->redirect('login/login');
        }else{
            $this->setViewParams('seller_info',$this->getUserInfo());
        }

        return true;
    }

    /**
     * 设置视图层信息
     * @param string $key 
     * @param mixed $value
     */
    public function setViewParams($key,$value) {
        Yii::$app->view->params[$key] = $value;
    }

    /**
     * ajax返回数据
     * @param int     $code       接口状态码
     * @param array   $data       接口返回数据
     * @param string  $message    接口信息提示
     * @param boolean $res        接口处理结果
     * @return array
     */
    public function returnData($code = 200,$data = [] , $message = '',$res = false){
        if($code == 200){$res = true;}
        return ['res'=>$res,'code'=>$code,'message'=>$message,'data'=>$data];
    }

    public function getUserInfo(){
        return $this->isLogin() ? Yii::$app->getUser()->identity->attributes : [] ;
    }

    public function getUserId(){
        return $this->isLogin() ? Yii::$app->getUser()->id : 0 ;
    }

    /**
     * 判断用户是否登录
     */
    public function isLogin(){
        return !Yii::$app->user->isGuest && Yii::$app->user->id;
    }

}