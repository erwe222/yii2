<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
/**
 * 前台主控制器
 */
class WebController extends Controller{
    
    // 访问控制器前进行处理
    public function beforeAction($action)
    {
    	header('Content-Type:text/html;charset=utf-8');

        $this->is_Moile();

        $this->setSeo($action->id);
        return true;
    }
    
    /**
     * 设置前台seo信息
     */
    public function setSeo($action_id){

        return true;
    }
    
    public function is_Moile(){
        if(isMobile()){
            
        }else{

        }

        return true;
    }
}
