<?php
namespace admin\controllers;

use Yii;
use common\models\SellerApiClass;
use common\models\UserApiClass;
class SiteController extends CController{

    public function actionError(){
        $exception = Yii::$app->errorHandler->exception;
        if(Yii::$app->request->isAjax){
            return $this->asJson($this->returnData(403, [], '对不起，您现在还没获得该操作的权限!', false));
        }else if ($exception !== null) {
            if($this->isLogin()){
                return $this->render('error', ['exception' => $exception]);
            }else{
                return $this->renderPartial('error', ['exception' => $exception]);
            }
        }
    }
    
    public function actionTest(){
        return $this->render('test');
    }
    
    /**
     * 获取分类列表
     */
    public function actionGetPostDataMenu(){
        $res = SellerApiClass::getInstance()->getSellerList();
        $array = array('code'=>0,'msg'=>'','count'=>$res['data']['toatl_num'],'data'=>$res['data']['infos']);
        return $this->asJson($array);
    }
    
    
    public function actionTests(){
        $res = UserApiClass::getInstance()->getUserList(['page_index'=>1,'page_size'=>2]);
    }
}
