<?php

namespace frontend\modules\mobile\controllers;
use Yii;
use frontend\modules\mobile\controllers\CController;
use common\models\UserAddress;
use common\models\UserApiClass;
use common\models\StationMessage;

/**
 * 前台用户相关控制器
 * @author dell
 */
class UserController extends CController
{
    
    //默认控制器
    public $defaultAction = 'main';

    /**
     * 控制器权限控制
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        if(!$this->is_Login()){
            $this->redirect('/mobile/login/signin');
        }
        return true;
    }

    /**
     * 用户中心
     */
    public function actionMain(){
        return $this->render('main',
            array(
                'user_info'=>$this->getUserInfo()
            )
        );
    }
    
    /**
     * 我的信息
     */
    public function actionMyUser(){
        $user_info = $this->getUserInfo();
        return $this->render('my-user',array(
            'user_info'=>$user_info
        ));
    }
    
    /**
     * 用户地址列表页面
     */
    public function actionMyAddress(){
        $user_id = $this->getUserID();
        
        $addr_infos = UserAddress::find()->where(['user_id'=>$user_id])->select('*')->asArray()->all();
        return $this->render('my-address',array(
            'addr_infos'=>$addr_infos
        ));
    }
    
    /**
     * 用户地址编辑页面
     */
    public function actionEditAddress(){
        $user_id = $this->getUserID();
        $addr_id = Yii::$app->request->get('addrid',0);
        $addr_infos = UserAddress::find()->where(['user_id'=>$user_id,'id'=>$addr_id])->select('*')->asArray()->one();
        return $this->render('edit-address',array(
            'addr_info'=>$addr_infos,
            'is_edit'=>empty($addr_infos)?false:true
        ));
    }
    
    /**
     * 用户地址添加或修改
     */
    public function actionAddressSave(){
        $user_id    = $this->getUserID();
        $id         = (int)Yii::$app->request->post('id',0);
        $consignee  = Yii::$app->request->post('consignee','');
        $mobile     = Yii::$app->request->post('mobile','');
        $city       = Yii::$app->request->post('city','');
        $address    = Yii::$app->request->post('address','');
        $is_default = Yii::$app->request->post('is_default','n');
        $is_add = ($id == 0)?true:false;
        if($id === 0){
            $model = new UserAddress();
        }else{
            $model = UserAddress::find()->where(['user_id'=>$user_id,'id'=>$id])->select('*')->one();
            if(!$model){
                return json_encode(array('errCode'=>302,'errMsg'=>'编辑地址不存在'));
            }
        }
        $model->user_id = $user_id;
        $model->consignee = $consignee;
        $model->mobile = $mobile;
        $model->city = $city;
        $model->address = $address;
        $model->is_default = $is_default;
        if($model->is_default == 'y'){
            if($is_add){
                UserAddress::updateAll(array('is_default'=>'n'),'user_id =:user_id and is_default =:is_default',array(':user_id'=>$user_id,':is_default'=>'y'));
            }else{
                UserAddress::updateAll(array('is_default'=>'n'),'user_id =:user_id and is_default =:is_default AND id !=:id',array(':user_id'=>$user_id,':is_default'=>'y',':id'=>$model->id));
            }
        }
        if($model->save()){
            $arrJson['errCode'] = 200;
            $arrJson['errMsg'] = $is_add ? '添加地址成功':'修改地址成功';
        }else{
            $arrJson['errCode'] = 301;
            $arrJson['errMsg'] = $is_add ? '添加地址失败':'修改地址失败';
        }
        return json_encode($arrJson);
    }
    
    /**
     * 修改用户的默认地址
     */
    public function actionUpdateDefaultAddr(){
        $user_id    = $this->getUserID();
        $addr_id    = (int)Yii::$app->request->post('addrid',0);
        $transaction = UserAddress::getDb()->beginTransaction();
        try {
            UserAddress::updateAll(array('is_default'=>'n'),'user_id =:user_id and is_default =:is_default AND id !=:id',array(':user_id'=>$user_id,':is_default'=>'y',':id'=>$addr_id));
            UserAddress::updateAll(array('is_default'=>'y'),'user_id =:user_id AND id =:id',array('user_id'=>$user_id,':id'=>$addr_id));
            $transaction->commit();
            $arrJson['errCode'] = 200;
            $arrJson['errMsg'] = '默认设置成功';
        } catch(\Exception $e) {
            $transaction->rollBack();
            $arrJson['errCode'] = 301;
            $arrJson['errMsg'] = '默认设置失败';
        }
        return json_encode($arrJson);
    }

    /**
     * 删除用户地址
     */
    public function actionDelAddr(){
        $user_id    = $this->getUserID();
        $addr_id    = (int)Yii::$app->request->post('addrid',0);
        $addr_info = UserAddress::find()->where(['user_id'=>$user_id,'id'=>$addr_id])->one();
        if($addr_info){
            if($addr_info->is_default == 'y'){
                $arrJson['errCode'] = 302;
                $arrJson['errMsg'] = '默认地址不能删除';
            }else if($addr_info->delete()){
                $arrJson['errCode'] = 200;
                $arrJson['errMsg'] = '删除地址成功';
            }else{
                $arrJson['errCode'] = 301;
                $arrJson['errMsg'] = '删除地址失败';
            }
        }else{
            $arrJson['errCode'] = 301;
            $arrJson['errMsg'] = '删除地址失败';
        }
        return json_encode($arrJson);
    }

    /**
     * 个人设置页面
     */
    public function actionMySetup(){
        return $this->render('my-setup');
    }
    
    /**
     * 订单收银台
     */
    public function actionSettlement(){
        return $this->render('settlement');
    }
    
    /**
     * 用户签到页面
     */
    public function actionMySign(){
        return $this->render('my-sign');
    }
    
    /**
     * 用户分享页面
     */
    public function actionMyShare(){
        return $this->render('my-share');
    }
    
    /**
     * 用户优惠劵页面
     */
    public function actionMyCoupon(){
        return $this->render('my-coupon');
    }
    
    /**
     * 用户帮助中心
     */
    public function actionMyHelp(){
        return $this->render('my-help');
    }
    
    /**
     * 我的分享列表
     */
    public function actionMyShareList(){
        return $this->render('my-share-list');
    }
    
    /**
     * 个人消息
     */
    public function actionMyMessage(){
        return $this->render('my-message');
    }
    
    /**
     * ajax 获取消息列表
     */
    public function actionGetMessageList(){
        $page_index    = (int)Yii::$app->request->post('pageindex',1);
        $data = [
            'user_id'=>$this->getUserID(),
            'type'=>3,
            'is_show'=>1,
            'page_index'=>$page_index,
            'page_size'=>15,
        ];

        $res = UserApiClass::getInstance()->getWebNews($data);
        if(count($res['data']['infos']) > 0){
            foreach($res['data']['infos'] as $key=>$val){
                $str = formatHumanDateTime($val['create_time']);
                if(strlen($str) == 19){
                   $str = date('m-d H:i',  strtotime($val['create_time'])); 
                }
                $res['data']['infos'][$key]['create_time'] = $str;
            }
        }
        
        $this->asJson($res['data']);
    }
    
    /**
     * 公告详情
     */
    public function actionMyMessageInfo(){
       $id    = (int)Yii::$app->request->get('id',0);
       if($id == 0){
           return $this->redirect('my-message');
       }else{
            $res = UserApiClass::getInstance()->getWebNews(['id'=>$id]);
            return $this->render('my-message-info', $res['data']);
       }
    }
    
    /**
     * 删除消息
     */
    public function actionDelMessage(){
        $id    = (int)Yii::$app->request->post('id',0);
        $user_id = $this->getUserID();
        $res = UserApiClass::getInstance()->delWebNews(['id'=>$id,'type'=>3,'user_id'=>$user_id]);
        if($res['res']){
            $arrJson['errCode'] = 200;
            $arrJson['errMsg'] = '删除成功';
        }else{
            $arrJson['errCode'] = 302;
            $arrJson['errMsg'] = '删除失败';
        }

        $arrJson['res'] = $res;
        return json_encode($arrJson);
    }
}
