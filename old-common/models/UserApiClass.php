<?php
namespace common\models;
use Yii;
use common\models\StationMessage;
use common\models\UserAddress;
use frontend\models\User;
use common\models\SmsLog;
use common\components\sms\Sms;

class UserApiClass extends ApiClass{

    private static $_instance = null;

    /**
     * 静态方法，单例统一访问入口
     */
    static public function getInstance() {
        if (is_null ( self::$_instance ) || isset ( self::$_instance )) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    /**
     * 添加网站内部消息
     */
    public function addWebNews($params){
        if(!isset($params['type'])){
            return 'type 参数未设置';
        }
        
        if((int)$params['type'] == 3 && !isset($params['user_id']) && empty($params['user_id'])){
            return 'user_id 参数不能为空';
        }
        
        if((int)$params['type'] == 4 && !isset($params['admin_id']) && empty($params['admin_id'])){
            return 'admin_id 参数不能为空';
        }
        
        $model = new StationMessage;
        $model->type = $params['type'];
        $model->user_id = $params['user_id'];
        $model->admin_id = $params['admin_id'];
        $model->title = $params['title'];
        $model->message = $params['message'];
        $model->is_read = $params['is_read'];
        $model->is_show = $params['is_show'];
        $model->create_time = date('Y-m-d H:i:s');
        if($model->save(false)){
            return $this->returnData(200, $model, '消息添加成功', true);
        }else{
            return $this->returnData(302, $model, '消息添加失败', false);
        }
        
    }

    /**
     * 修改网站内部消息
     */
    public function editWebNews($params){
        if (!isset($params['id'])){
            return $this->returnData([],$this->getParamErrTip('id'),301);
        }

        $info = StationMessage::find()->where(['id'=>(int)$params['id']])->one();
        if($info && ($info->type == 1 || $info->type == 2)){
            $info->title = isset($params['title'])?$params['title']:$info->title;
            $info->message = isset($params['message'])?$params['message']:$info->message;
            if($info->save(false)){
                return $this->returnData(200, [], '信息修改成功', true);
            }else{
                return $this->returnData(302, [], '信息修改失败', false);
            }
        }else{
            return $this->returnData(304, [], '本条记录不支持修改', false);
        }
    }

    /**
     * 获取网站消息
     * @return array
     */
    public function getWebNews($params){
        $where = [];
        if(isset($params['id'])){
            $where['id'] = $params['id'];
        }else{
            if(isset($params['type'])){$where['type'] = $params['type'];}
            if(isset($params['user_id'])){$where['user_id'] = $params['user_id'];}
            if(isset($params['admin_id'])){$where['admin_id'] = $params['admin_id'];}
            if(isset($params['is_show'])){$where['is_show'] = $params['is_show'];}
        }
        
        if(isset($params['id'])){
            $arr = StationMessage::find()->where($where)->select('*')->asArray()->all();
            if(isset($params['id']) && $arr && $arr[0]['is_read'] == 1){
                StationMessage::updateAll(['is_read'=>2],['id'=>$params['id']]);
            }
            
            $arr = array_merge(['infos'=>$arr],array('toatl_num'=>1,'page_index'=>1,'page_num'=>1));
        }else{
            $total = StationMessage::find()->where($where)->select('*')->asArray()->count();
            $pageindex = isset($params['page_index'])?$params['page_index']:1;
            $pagesize  = isset($params['page_size'])?$params['page_size']:$total;
            $resArr = $this->getPageNum($total,$pageindex,$pagesize);
            
            $arr = StationMessage::find()->where($where)->select('*')->orderBy(['is_read'=>'DESC','create_time'=>'DESC'])->offset($resArr['offset'])->limit($resArr['limit'])->asArray()->all();
            $arr = array_merge(['infos'=>$arr],$resArr);
        }
        
        return $this->returnData(200, $arr, '', true);
    }
    
    /**
     * 删除网站消息
     * @param type $params
     */
    public function delWebNews($params){
        if (!isset($params['type'])){
            return $this->returnData(301,[],$this->getParamErrTip('type'));
        }else if ((int)$params['type'] == 3 && !isset($params['user_id'])){
            return $this->returnData(301,[],'user_id 字段不能为空');
        }else if((int)$params['type'] == 4 && !isset($params['admin_id'])){
            return $this->returnData(301,[],'admin_id 字段不能为空');
        }

        if($params['type'] == 1 || $params['type'] == 2){
            $rt= StationMessage::updateAll(array('is_show'=>'2'),'id=:id',array(':id'=>(int)$params['id']));
        }else if($params['type'] == 3){
            $rt= StationMessage::updateAll(array('is_show'=>'2'),'id=:id AND user_id=:user_id',array(':id'=>(int)$params['id'],':user_id'=>(int)$params['user_id']));
        }else if($params['type'] == 4){
            $rt= StationMessage::updateAll(array('is_show'=>'2'),'id=:id AND admin_id=:admin_id',array(':id'=>(int)$params['id'],':admin_id'=>(int)$params['admin_id'])); 
        }
        
        if($rt !== false){
            return $this->returnData(200, [], '删除成功', true);
        }else{
            return $this->returnData(304, [], '删除失败', false);
        }
    }

    /**
     * 获取网站前台用户地址列表消息
     * @return array
     */
    public function getFrontUserAddr($params){
        $user_id = isset($params['user_id'])?$params['user_id']:0;
        $where = ['user_id'=>$user_id];
        if(isset($params['id'])){
            $where['id'] = $params['id'];
        }else{
            if(isset($params['is_default'])){$where['is_default'] = $params['is_default'];}
        }

        $sql = UserAddress::find()->where($where)->select('*');

        if(isset($params['id'])){
            $arr = $sql->asArray()->all();
            $arr = array_merge(['infos'=>$arr],array('toatl_num'=>1,'page_index'=>1,'page_num'=>1));
        }else{
            $total = $sql->asArray()->count();
            $pageindex = isset($params['page_index'])?$params['page_index']:1;
            $pagesize  = isset($params['page_size'])?$params['page_size']:$total;
            $resArr = $this->getPageNum($total,$pageindex,$pagesize);
            $arr = $sql->orderBy('updated_time DESC')->offset($resArr['offset'])->limit($resArr['limit'])->asArray()->all();
            $arr = array_merge(['infos'=>$arr],$resArr);
        }
        return $arr;
    }

    /**
     * 前台用户更新默认收货地址
     * @param array $params
     * @return boolean
     */
    public function updateFrontUserDefaultAddr($params){
        $user_id    = (int)$params['user_id'];
        $addr_id    = (int)$params['addr_id'];
        $transaction = UserAddress::getDb()->beginTransaction();
        try {
            UserAddress::updateAll(array('is_default'=>'n'),'user_id =:user_id and is_default =:is_default AND id !=:id',array(':user_id'=>$user_id,':is_default'=>'y',':id'=>$addr_id));
            UserAddress::updateAll(array('is_default'=>'y'),'user_id =:user_id AND id =:id',array('user_id'=>$user_id,':id'=>$addr_id));
            $transaction->commit();
            return true;
        } catch(\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * 前台用户收件地址删除操作
     * @return boolean
     */
    public function delFrontUserAddr($params){
        $user_id    = (int)$params['user_id'];
        $addr_id    = (int)$params['addr_id'];
        $addr_info = UserAddress::find()->where(['user_id'=>$user_id,'id'=>$addr_id])->one();
        if($addr_info){
            if($addr_info->is_default == 'y'){
                return '默认地址不能删除';
            }else if($addr_info->delete()){
                return true;
            }
        }
        return false;
    }

    /**
     * 前台用户收件地址编辑操作
     * @return boolean
     */
    public function editFrontUserAddr($params){
        $is_new     = $params['is_add'];
        $user_id    = $params['user_id'];
        $addr_id    = $params['addr_id'];
        $consignee  = $params['consignee'];
        $mobile     = $params['mobile'];
        $city       = $params['city'];
        $address    = $params['address'];
        $is_default = $params['is_default'];
        if($is_new){
            $model = new UserAddress();
        }else{
            $model = UserAddress::find()->where(['user_id'=>$user_id,'id'=>$addr_id])->select('*')->one();
            if(!$model){return false;}
        }
        $model->user_id         = $user_id;
        $model->consignee       = $consignee;
        $model->mobile          = $mobile;
        $model->city            = $city;
        $model->address         = $address;
        $model->is_default      = $is_default;
        if($model->is_default == 'y'){
            if($is_add){
                UserAddress::updateAll(array('is_default'=>'n'),'user_id =:user_id and is_default =:is_default',array(':user_id'=>$user_id,':is_default'=>'y'));
            }else{
                UserAddress::updateAll(array('is_default'=>'n'),'user_id =:user_id and is_default =:is_default AND id !=:id',array(':user_id'=>$user_id,':is_default'=>'y',':id'=>$model->id));
            }
        }
        return $model->save();
    }

    /**
     * 前台用户密码重置
     */
    public function resetFrontUserPwd($params){
        
    }

    /**
     * 前台用户找回密码
     */
    public function findFrontUserPwd($params){
        
    }

    /**
     * 发送前台找回密码邮件
     */
    public function sendFindPwdEdm($params){
        
    }

    /**
     * 忘记密码重置
     */
    public function setForgetPwd($params){
        
    }

    /**
     * 编辑前台用户信息
     */
    public function editFrontUserInfo($params){
        $user_id = $params['user_id'];
        $info = User::find()->where(['id'=>$user_id])->select('*')->one();
        if($info){
            if(isset($params['status'])){$info->status = $params['status'];}
            if(isset($params['email'])){$info->email = $params['email'];}
            return $info->save();
        }
        return false;        
    }
    
    /**
     * 获取前台用户列表
     * @return array
     */
    public function getUserList($params){

        $query = User::find();
        if(isset($params['id'])){
            $arr = User::find()->where(['id'=>$params['id']])->select('*')->asArray()->all();
            $arr = array_merge(['infos'=>$arr],array('toatl_num'=>1,'page_index'=>1,'page_num'=>1));
            $total = 1;
        }else{
            $where = [];

            $orderby    = isset($params['orderby'])?$params['orderby']:'created_at';

            $sort       = isset($params['sort'])?$params['sort']:'DESC';

            if(isset($params['where']['status'])){
                $where['status'] = $params['where']['status'];
            }
            
            $query->where($where);
            
            //模糊查询
            if(isset($params['where']['username'])){
                $query->andWhere(['like', 'username', $params['where']['username']]);
            }

            if(isset($params['where']['email'])){
                $query->andWhere(['like', 'email', $params['where']['email']]);
            }

            $total = $query->select('*')->count();

            $pageindex = isset($params['page_index'])?$params['page_index']:1;
            $pagesize  = isset($params['page_size'])?$params['page_size']:$total;
            
            $resArr = $this->getPageNum($total,$pageindex,$pagesize);
            
            $arr = $query->select('*')->orderBy("$orderby $sort")->offset($resArr['offset'])->limit($resArr['limit'])->asArray()->all();
        }


        return $this->returnData(200,[
            'infos' =>$arr,
            'offset' => $resArr['offset'],
            'limit' => $resArr['limit'],
            'toatl_num' => $total,
            'page_index' => $pageindex,
            'page_num' => $pagesize,
        ],"",true);
    }

    /**
     * 短信,邮件验证码校验
     * @return boolean
     */
    public function checkSmsCode($params){
        $where = ['is_check'=>1];

        //验证码发送方式
        $where['send_type'] = isset($params['send_type'])?$params['send_type']:1;
        
        //待验证的验证码
        $code = isset($params['code'])?$params['code']:0;

        if(isset($params['type'])){$where['type'] = $params['type'];}
        if($where['send_type'] == 1){
            $where['mobile'] = isset($params['mobile'])?$params['mobile']:'';
        }else{
            $where['email'] = isset($params['email'])?$params['email']:'';
        }

        //构建查询器
        $info = SmsLog::find()->where($where)->select('*')->orderBy("created_time DESC")->one();
        if($info){
            //校验验证码是否一致
            if($info->code != $code){return false;}

            //校验验证码是否已过期
            if(strtotime($info->expiry_time) < time()){
                return '验证码已过期';
            }
            $info->is_check = 2;
            $info->save(false);
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 发送短信,邮件验证码
     */
    public function sendSmsCode($params){
        $randomNum = getRand(6);
        $type = isset($params['type'])?$params['type']:1;
        $send_type = isset($params['send_type'])?$params['send_type']:1;
        if($send_type == 1){
            switch ($type){
                case 1:$message = "【远购网】感谢您的注册，本次注册验证码为{$randomNum}，请于3分钟内正确输入，切勿泄露他人。（仅供参考）";break;
                case 2:$message = "【远购网】您的找回密码验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
                case 3:$message = "【远购网】您的修改交易密码验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
                default :$message = "【远购网】您的注册验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
            }
        }else{
            switch ($type){
                case 1:$title = '远购网注册';    $message = "【远购网】您的注册验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
                case 2:$title = '远购网找回密码';$message = "【远购网】您的找回密码验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
                case 3:$title = '修改交易密码';  $message = "【远购网】您的修改交易密码验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
                default :$title = '远购网注册';  $message = "【远购网】您的注册验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
            }
        }

        $smsLog= new SmsLog();        
        $smsLog->user_id        =   isset($params['user_id'])?$params['user_id']:0; 
        $smsLog->send_type      =   $send_type;
        $smsLog->type           =   isset($params['type'])?$params['type']:1; 
        $smsLog->mobile         =   isset($params['mobile'])?$params['mobile']:''; 
        $smsLog->email          =   ($params['send_type'] == 2)?(isset($params['email'])?$params['email']:''):$smsLog->mobile.'@139.com'; 
        $smsLog->is_check       =   1;
        $smsLog->expiry_time    =   date('Y-m-d H:i:s',strtotime("+10 minute"));
        $smsLog->created_time   =   date('Y-m-d H:i:s');
        $smsLog->code           =   $randomNum; 
        $smsLog->message        =   $message;
        $is_true = $smsLog->save();
        if($is_true){
            if($smsLog->send_type == 2 && $smsLog->email != '@139.com'){
                $centent =<<<CTN
                    <div style="width:100%;max-width:540px;border: 1px solid #ccc;background-image: url(http://59.110.168.230:8181/assets/email/background-img.jpg);min-height:200px;margin:0 auto;padding:5px;">
                        <div>
                            <h4 style="text-indent: 5px;">尊敬的用户:</h4>
                            <div style="text-indent: 30px">
                                 <span>{$message}</span>
                            </div>
                        </div>
                    </div>
CTN;
                //邮件发送
                return $mail = Yii::$app->mailer->compose()->setFrom(['837215079@qq.com' => $title])->setTo($smsLog->email)->setSubject($title)->setHtmlBody($centent)->send();
            }else if($smsLog->send_type == 1){
                //短信发送
                $options = Yii::$app->params['custom_config']['sms'];
                $ucpass = new Sms(['accountsid'=>$options['accountsid'],'token'=>$options['token']]);
                $templateid = '258714';
                $res = $ucpass->SendSms($options['appid'],$templateid,$smsLog->code,$smsLog->mobile,$uid='');
                $data = json_decode($res,true);
                if($data['code'] == '000000'){
                    return true;
                }else{
                    //短信发送失败记录错误日志
                    return false;
                }
            }
        }else{
            return false;
        }
    }
    
    /**
     * 验证用户手机号是否存在
     * @param type $params
     * @return boolean
     */
    public function checkUser($params){
        $username = isset($params['username'])?$params['username']:'';
        if(empty($username)){
            return false;
        }else{
            return User::find()->where(array('username'=>$username))->exists();
        }
    }
    
    /**
     * 修改用户信息
     */
    public function changeUserInfo($params){
        if (!isset($params['id'])){
            return $this->returnData([],$this->getParamErrTip('id'),301);
        }
        
        if(isset($params['status'])){
            $params['status'] = (int)$params['status'] == 10 ?10:0;
        }

        $res = User::find()->where(['id'=>(int)$params['id']])->one();
        if(!$res){
            return $this->returnData(302,[],"该用户不存在");
        }

        $filter_arr = array('id','username','password_hash','password_reset_token','created_at','updated_at','auth_key');
        foreach($res->attributes as $k=>$v){
            if(!in_array($k, $filter_arr) && isset($params[$k])){
                $res->$k = $params[$k];
            }
        }

        if($res->save(false)){
            return $this->returnData(200,[],"信息修改成功",true);
        }else{
            return $this->returnData(303,[],"信息修改失败");
        }
    }

}
