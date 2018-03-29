<?php
namespace common\models;
use Yii;
use common\models\SmsLog;
use common\components\sms\Sms;

/**
 * Description of ApiClass
 *
 * @author dell
 */
class ApiClass {
    
    
    /**
     * @param int $total  查询总数
     * @param int $pageindex  当前页
     * @param int $pagesize  当前页显示数
     * @return array
     */
    public function getPageNum($total,$pageindex,$pagesize){
       if($pagesize == 0){$pagesize =1;}
        $offset = (intval($pageindex) - 1) * intval($pagesize);
        return ['offset'=>$offset,'limit'=>(int)$pagesize,'toatl_num'=>(int)$total,'page_index'=>(int)$pageindex,'page_num'=>ceil((int)$total/(int)$pagesize)];
    }
    
    /**
     * 接口返回数据
     * @param int     $code       接口状态码
     * @param array   $data       接口返回数据
     * @param string  $message    接口信息提示
     * @param boolean $res        接口处理结果
     * @return array
     */
    public function returnData($code = 200,$data = [] , $message = '',$res = false){
        return ['res'=>$res,'code'=>$code,'message'=>$message,'data'=>$data];
    }
    
    /**
     * 获取接口参数丢失的提示信息
     */
    public function getParamErrTip($name){
        return "接口参数参数异常[{$name}]必传";
    }
    
    
    /**
     * 参数过滤方法
     * @param type $rule 过滤规则 例如: ['name'  => 'require|max:25','age'   => 'number|between:1,120',]
     * @param type $data 过滤验证数据
     * @return boolen|string
     */
    public function verifyParams($rule,$data){
        $validate = new \common\components\lib\Validate($rule);
        return $validate->check($data) ? true : $validate->getError();
    }
    
    /**
     * 短信验证码校验
     * 
     * 
     * @return array
     */
    public function checkSmsCode($params){
        $where = [];
        if (!isset($params['code'])){
            return $this->returnData(301,[],$this->getParamErrTip('code'));
        }else if (!isset($params['type'])){
            return $this->returnData(301,[],$this->getParamErrTip('type'));
        }else if (!isset($params['mobile'])){
            return $this->returnData(301,[],$this->getParamErrTip('mobile'));
        }

        $where['type'] = $params['type'];
        $where['mobile'] = $params['mobile'];

        //构建查询器
        $info = SmsLog::find()->where($where)->select('id,mobile,code,expiry_time')->orderBy("created_time DESC")->asArray()->one();
        if($info){
            if($info['code'] !== $params['code']){
                return $this->returnData(303,[],'验证码错误');
            }else if(time() > strtotime($info['expiry_time'])){
                return $this->returnData(303,[],'验证码过期');
            }else{
                return $this->returnData(200,$info,'验证码正确',TRUE);
            }
        }else{
            return $this->returnData(303,[],'验证码错误');
        }
    }
    
    /**
     * 发送短信,邮件验证码
     */
    public function sendSmsCode($params){
        if (!isset($params['type'])){
            return $this->returnData(301,[],$this->getParamErrTip('type'));
        }else if (!isset($params['send_type'])){
            return $this->returnData(301,[],$this->getParamErrTip('send_type'));
        }

        $randomNum = getRand(6);
        $type = (int)$params['type'];
        $send_type = (int)$params['send_type'];
        
        switch ($type){
            case 1:$title = '远购网注册';$message = "【远购网】感谢您的注册，本次注册验证码为{$randomNum}，请于3分钟内正确输入，切勿泄露他人。（仅供参考）";break;
            case 2:$title = '远购网找回密码';$message = "【远购网】您的找回密码验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
            case 3:$title = '修改交易密码';$message = "【远购网】您的修改交易密码验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
            default :$title = '远购网注册';$message = "【远购网】您的注册验证码为{$randomNum}。请在页面中提交验证码完成验证。";break;
        }

        $smsLog= new SmsLog();
        $smsLog->send_type      =   $send_type;
        $smsLog->type           =   isset($params['type'])?$params['type']:1; 
        $smsLog->mobile         =   isset($params['mobile'])?$params['mobile']:''; 
        $smsLog->email          =   isset($params['email']) && !empty($params['email']) ? $params['email'] : $smsLog->mobile.'@139.com';
        $smsLog->is_check       =   1;
        $smsLog->expiry_time    =   date('Y-m-d H:i:s',strtotime("+10 minute"));
        $smsLog->created_time   =   date('Y-m-d H:i:s');
        $smsLog->code           =   $randomNum; 
        $smsLog->message        =   $message;
        $is_true = $smsLog->save();
        if($is_true){
            if($smsLog->send_type == 2){
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
                $mail = Yii::$app->mailer->compose()->setFrom(['837215079@qq.com' => $title])->setTo($smsLog->email)->setSubject($title)->setHtmlBody($centent)->send();
                if($mail){
                    return $this->returnData(200,[],'邮件发送成功',true);
                }else{
                    return $this->returnData(302,[],'邮件发送失败',false);
                }
            }else if($smsLog->send_type == 1){//短信发送
                $options = Yii::$app->params['custom_config']['sms'];
                $ucpass = new Sms(['accountsid'=>$options['accountsid'],'token'=>$options['token']]);
                $templateid = '258714';
                $res = $ucpass->SendSms($options['appid'],$templateid,$smsLog->code,$smsLog->mobile,$uid='');
                $data = json_decode($res,true);
                if($data['code'] == '000000'){
                    return $this->returnData(200,[],'短信发送成功',true);
                }else{//短信发送失败记录错误日志
                    return $this->returnData(302,[],'短信发送失败',false);
                }
            }
        }else{
            return $this->returnData(302,[],'发送失败',false);
        }
    }
}
