<?php
namespace common\models;
use Yii;
use common\models\Seller;

class SellerApiClass extends ApiClass{

    //静态变量保存全局实例
    private static $_instance = null;
    
    //私有构造函数，防止外界实例化对象
    private function __construct() {
    }

    //私有克隆函数，防止外办克隆对象
    private function __clone() {
        
    }

    //静态方法，单例统一访问入口
    static public function getInstance() {
        if (is_null ( self::$_instance ) || isset ( self::$_instance )) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }
    
    /**
     * 商家注册接口
     */
    public function setSellerReg($params){
        if (!isset($params['mobile'])){
            return $this->returnData(301,[],$this->getParamErrTip('mobile'));
        }else if (!isset($params['password'])){
            return $this->returnData(301,[],$this->getParamErrTip('password'));
        }else if (!isset($params['code'])){
            return $this->returnData(301,[],$this->getParamErrTip('code'));
        }
        
        $res = Seller::find()->where(['seller_mobile'=>$params['mobile']])->asArray()->one();
        if($res){
            return $this->returnData(302,$res,"该手机号[{$res['seller_mobile']}]已被注册");
        }

        $checkSmsCode = $this->checkSmsCode(['mobile'=>$params['mobile'],'type'=>4,'code'=>$params['code']]);
        if($checkSmsCode['res'] === false){
            return $this->returnData(303,[],$checkSmsCode['message']);
        }
        
        $user = new Seller();
        $user->username = 'ygw'.$params['mobile'];
        $user->setPassword($params['password']);
        $user->generateAuthKey();
        $user->status = Seller::STATUS_ACTIVE;
        $user->seller_mobile = $params['mobile'];
        if($user->save()){
            return $this->returnData(200,$user,'注册成功',TRUE);
        }
        return $this->returnData(304,[],'注册失败',false);
    }

    /**
     * 用户登录验证
     */
    public function checkSellerLogin($params){
        if (!isset($params['username'])){
            return $this->returnData([],$this->getParamErrTip('username'),301);
        }else if (!isset($params['password'])){
            return $this->returnData([],$this->getParamErrTip('password'),301);
        }
        
        $res = Seller::find()->where(['username'=>$params['username']])->one();
        if(!$res){
            return $this->returnData(302,[],"该用户[{$params['username']}]不存在");
        }

        if(!$res->validatePassword($params['password'])){
            return $this->returnData(303,[],"该用户[{$res['username']}]密码错误");
        }

        if($res['status'] != Seller::STATUS_ACTIVE){
            return $this->returnData(304,[],"该用户[{$res['username']}]已被锁定");
        }

        return $this->returnData(200,$res,"",true);
    }

    /**
     * 修改商家信息
     */
    public function changeSellerInfo($params){
        if (!isset($params['seller_id'])){
            return $this->returnData([],$this->getParamErrTip('seller_id'),301);
        }
        
        $res = Seller::find()->where(['id'=>(int)$params['seller_id']])->one();
        if(!$res){
            return $this->returnData(302,[],"该用户不存在");
        }

        $filter_arr = array('id','username','password_hash','password_reset_token','seller_mobile','created_at','updated_at','auth_key','');
        foreach($res->attributes as $k=>$v){
            if(!in_array($k, $filter_arr) && isset($params[$k])){
                $res->$k = $params[$k];
            }
        }

        if($res->save(false)){
            return $this->returnData(200,$res->attributes,"信息修改成功",true);
        }else{
            return $this->returnData(303,[],"信息修改失败");
        }
    }

    /**
     * 修改商家登录密码
     */
    public function changeSellerPwd($params){
        if (!isset($params['seller_id'])){
            return $this->returnData(301,[],$this->getParamErrTip('seller_id'));
        }else if (!isset($params['old_password'])){
            return $this->returnData(301,[],$this->getParamErrTip('old_password'));
        }else if (!isset($params['new_password'])){
            return $this->returnData(301,[],$this->getParamErrTip('new_password'));
        }else if (!isset($params['confirm_password'])){
            return $this->returnData(301,[],$this->getParamErrTip('confirm_password'));
        }
        
        if($params['new_password'] != $params['confirm_password']){
            return $this->returnData(302,[],"两次密码不一致");
        }

        $res = Seller::find()->where(['id'=>(int)$params['seller_id']])->one();
        if(!$res){
            return $this->returnData(303,[],"该用户不存在");
        }

        if(!$res->validatePassword($params['old_password'])){
            return $this->returnData(304,[],"原始密码验证错误");
        }

        $res->password_hash = $newPass = Yii::$app->getSecurity()->generatePasswordHash($params['new_password']);

        if($res->save(false)){
            return $this->returnData(200,[],'登录密码修改成功',TRUE);
        }

        return $this->returnData(305,[],'登录密码修改失败',false);
    }

    /**
     * 商家登录密码重置
     */
    public function resetSellerPwd($params){
        if (!isset($params['mobile'])){
            return $this->returnData([],$this->getParamErrTip('mobile'),301);
        }else if (!isset($params['new_password'])){
            return $this->returnData([],$this->getParamErrTip('new_password'),301);
        }else if (!isset($params['code'])){
            return $this->returnData([],$this->getParamErrTip('code'),301);
        }

        $res = Seller::find()->where(['seller_mobile'=>$params['mobile']])->one();
        if(!$res){
            return $this->returnData(302,[],"该用户不存在");
        }

        $checkSmsCode = $this->checkSmsCode(['mobile'=>$params['mobile'],'type'=>5,'code'=>$params['code']]);
        if($checkSmsCode['res'] === false){
            return $this->returnData(302,[],$checkSmsCode['message']);
        }
        
        $res->password_hash = $newPass = Yii::$app->getSecurity()->generatePasswordHash($params['new_password']);
        
        if($res->save(false)){
            return $this->returnData(200,[],'登录密码重置成功',TRUE);
        }

        return $this->returnData(305,[],'登录密码重置失败',false);
    }

    /**
     * 获取商家列表信息
     */
    public function getSellerList($params =[]){
        $where = [];

        if(isset($params['id'])){
            $where['id'] = $params['id'];
        }else{
            $orderby    = isset($params['orderby'])?$params['orderby']:'created_at';
            $sort       = isset($params['sort'])?$params['sort']:'DESC';
            if(isset($params['status'])){$where['status'] = $params['status'];}
        }

        //构建查询器
        $query = Seller::find();
        
        if(isset($params['id'])){
            $arr = $query->where($where)->select('*')->asArray()->all();
            $arr = array_merge(['infos'=>$arr],array('toatl_num'=>1,'page_index'=>1,'page_num'=>1));
        }else{
            $query->where($where);

            //模糊查询
            if(isset($params['mobile'])){
                $query->andWhere(['like', 'username', $params['username']]);
            }

            $total = $query->select('*')->count();

            $pageindex = isset($params['page_index'])?$params['page_index']:1;
            $pagesize  = isset($params['page_size'])?$params['page_size']:$total;
            
            $resArr = $this->getPageNum($total,$pageindex,$pagesize);
            
            $arr = $query->select('*')->orderBy("$orderby $sort")->offset($resArr['offset'])->limit($resArr['limit'])->asArray()->all();
            
            $arr = array_merge(['infos'=>$arr],$resArr);
        }

        return $this->returnData(200,$arr);
    }
    
    public function checkSeller($params) {
        if (!isset($params['username'])){
            return $this->returnData([],$this->getParamErrTip('username'),301);
        }
        $res = Seller::find()->where(['seller_mobile'=>$params['username']])->exists();
        if($res){
            return $this->returnData(200,[],"该用户存在",true);
        }  else {
            return $this->returnData(200,[],"该用户不存在",false);
        }
    }

}
