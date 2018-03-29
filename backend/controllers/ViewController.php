<?php
namespace backend\controllers;
use Yii;
use yii\helpers\Json;
use common\components\weixin\WeChatApi;


class ViewController extends CController {

    /**
     * 获取后台操作日志列表
     */
    public function actionShowManageLogList(){
        return $this->render('showmanageloglist');
    }
    
    /**
     * 微信公众号菜单管理
     */
    public function actionWechatMenu(){
        $model = new WeChatApi();
        $res = $model->getMenu();
        return $this->render('wechatmenu',array(
            'menu'=>var_export($res,true)
        ));
    }
    
    

}
