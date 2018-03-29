<?php
namespace seller\controllers;
use Yii;
use api\models\SellerApiClass;

/**
 * Description of TestController
 *
 * @author dell
 */
class TestController extends CController{
    
    public function actionTest(){
        $seller_id = $this->getUserId();
        $res = SellerApiClass::getInstance()->changeSellerPwd(
            [
                'seller_id'=>$seller_id,
                'old_password'=>'123456',
                'new_password'=>'654321',
                'confirm_password'=>'654321',
            ]
        );
        dump($res);
    }
    
}
