<?php
namespace admin\controllers;
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
        }

        //判断是否是ajax访问
        if (!Yii::$app->request->isAjax){
            $this->setViewParams('seller_info',$this->getUserInfo());
            $this->setViewParams('layout',$this->layout == null ?'main':$this->layout);
            
            $controller = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
            if('index/index' == strtolower($controller)){
                $this->layout = 'tab_main';
            }
        }

        $this_url = $action->controller->id . '/' . $action->id;
        if(Yii::$app->params['is_authorization'] && $this->getUserInfo()['username'] != 'admin' && !in_array($this_url, $this->getSkipAuthorizationUrl()) && !Yii::$app->user->can($this_url) && Yii::$app->getErrorHandler()->exception === null) {
            // 没有权限AJAX返回
            throw new \yii\web\ForbiddenHttpException("对不起，您现在还没获得该操作的权限!");
        }
        return true;
    }
    
    public function init() {
        parent::init();
        
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
    
    //获取跳过权限验证的url地址
    public function getSkipAuthorizationUrl(){
        
//        $this->layout = 'main';
        return [
            //auth控制器的url
            'auth/get-menu-box',
            
            
            //其它控制器
        ];
    }

}