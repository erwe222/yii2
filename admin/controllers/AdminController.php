<?php
namespace admin\controllers;
use Yii;
use yii\filters\AccessControl;
use common\models\AdminApiClass;

class AdminController extends CController{
    
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
    
    /**
     * 商家个人信息
     */
    public function actionMyInfo(){
        $admin_id = $this->getUserId();
        $as = AdminApiClass::getInstance()->getManagerInfo(['id'=>$admin_id]);
        
        $album_list = AdminApiClass::getInstance()->getManagerAlbumList(['admin_id'=>$admin_id]);
        return $this->render('my-info', array('info'=>$as,'album_list'=>$album_list['data']['infos']));
    }
    
    /**
     * 管理员修改个人密码
     */
    public function actionChangeAdminPwd(){
        $admin_id = $this->getUserId();
        $data = [];
        $data['id'] = $admin_id;
        $data['old_password'] = Yii::$app->request->post('old_password','');
        $data['password'] = Yii::$app->request->post('password','');
        $data['password2'] = Yii::$app->request->post('password2','');
        $res = AdminApiClass::getInstance()->changeManagerPwd($data);
        if($res['code'] == 301){
            return $this->asJson($this->returnData(301,[] ,'参数填写错误'));
        }
        return $this->asJson($res);
    }
    
    /**
     * 管理员修改个人信息
     */
    public function actionChangeAdminInfo(){
        $data = [
            'id'=>$this->getUserId(),
            'email'=>Yii::$app->request->post('email',''),
            'user_telephone'=>Yii::$app->request->post('phone',''),
            'user_wechat'=>Yii::$app->request->post('wechat',''),
            'user_qq'=>Yii::$app->request->post('qq',''),
            'sex'=>Yii::$app->request->post('sex','1'),
            'birth_date'=>Yii::$app->request->post('date',''),
            'declaration'=>Yii::$app->request->post('declaration',''),
        ];
        $res = AdminApiClass::getInstance()->changeManagerInfo($data);
        if($res['code'] == 301){
            return $this->asJson($this->returnData(301,[] ,'参数填写错误'));
        }
        return $this->asJson($res);
    }
    
    /**
     * 上传相册图片
     */
    public function actionUploadImages(){
        $array = $_FILES['file'];
        $calss = new \admin\components\UploadPhoto($this->getUserId(),[$array]);
        if($calss->upload()){
            AdminApiClass::getInstance()->uploadManagerAlbum(['id'=>$this->getUserId(),'files'=>$calss->getSuccessFile()]);
            return $this->asJson($this->returnData(200,$calss->getSuccessFile() ,'上传成功'));
        }else{
            return $this->asJson($this->returnData(301,[] ,$calss->getErrorMsg()));
        }
    }
    
    /**
     * 测试方法
     */
    public function actionTest(){
        $admin_id = $this->getUserId();
        $as = AdminApiClass::getInstance()->uploadManagerAlbum(['id'=>$admin_id,'files'=>'']);
        dump($as);
    }
}
