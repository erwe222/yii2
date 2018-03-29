<?php
namespace backend\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\components\Helper;
use backend\models\Admin;
use backend\models\AuthItem;
use backend\models\SignupForm;

class UserController extends CController {

    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'create' => ['post'],
                ],
            ],
        ];
    }

    public $enableCsrfValidation = false;

    /**
     * 后台管理人员列表
     * @return [type] [description]
     */
    public function actionManager(){
        $role_infos = AuthItem::find()->where(['type'=>'1'])->select('name')->asArray()->all();
        return $this->render('manager',array('role_infos'=>$role_infos));
    }

    /**
     * 获取后台管理人员列表数据
     */
    public function actionGetManagerList(){
        $search_params = $this->query();
        $sql = 'SELECT id,username,email,`status`,created_at,(SELECT item_name from yd_auth_assignment auth where auth.user_id = admin.id LIMIT 1) as role_name from yd_admin admin where 1=1 ';
        if(isset($search_params['where']['username'])){
            $sql .= " AND admin.username = '{$search_params['where']['username']}'";
        }
        if(isset($search_params['where']['email'])){
            $sql .= " AND admin.email like '%{$search_params['where']['email']}%'";
        }
        $conunt = Admin::findBySql($sql)->count();
        $sql .= " order by {$search_params['orderBy']} {$search_params['sort']} limit {$search_params['offset']},{$search_params['limit']}";
        $query2 = Admin::findBySql($sql);
        $route_array = $query2->asArray()->all();
        $filter_totel = count($route_array);

        #服务端返回的JSON数据如下所示。其中draw是请求中的draw参数，data是表格中的数据。recordsFiltered是过滤后的数据总数，recordsTotal是原始数据总数。
        $array = array(
            'iTotalDisplayRecords'=>$conunt,
            'iTotalRecords'=>$filter_totel,
            'sEcho'=>$search_params['echo'],
            'data'=>$route_array,
        );

        return Json::encode($array);
    }

    /**
     * 添加管理人员帐号
     */
    public function actionAddManager(){
        $arrJson = ['errCode' => 202,'errMsg'  => '添加用户失败，请稍候重试。。。','data'    => []];
        $model = new SignupForm();
        $data = Yii::$app->request->post();
        if ($model->load(['params' => $data], 'params')) {
            if ($user = $model->signup()) {
                $arrJson['errCode'] = 201;
                $arrJson['errMsg'] = '添加用户成功';
            }
        }
        return json_encode($arrJson);
    }

    /**
     * 修改后台人员信息
     */
    public function actionUpdateManager(){
        $arrJson = ['errCode' => 202,'errMsg'  => '数据修改失败，请稍候重试。。。','data'    => []];
        $data = Yii::$app->request->post();
        if($data){
            $model_info = Admin::findOne(['id' => $data['id']]);
            if($model_info){
                $model_info->email = $data['email'];
                $model_info->status = (int)$data['status'];
                $model_info->role_name = isset($data['role_name'])?$data['role_name']:'';
                if($model_info->save()){
                    $arrJson['errCode'] = 201;
                    $arrJson['errMsg'] = '数据修改成功';
                }
            }
        }
        return json_encode($arrJson);
    }

    /*
     * 管理员个人信息
     */
    public function actionManagerInfo() {
        $admin_id = YII::$app->user->id;
        $admin_info = Admin::findIdentity($admin_id);
        $auth = Yii::$app->authManager;
        $role_names = $auth->getRolesByUser($admin_id);
        $role_name = '';
        if(count($role_names) > 0){
            foreach ($role_names as $key=>$_v){
                $role_name .= ','.$key;
            }
            $role_name = ltrim($role_name,',');
        }

        return $this->render('manager-info',array('admin_info'=>$admin_info,'role_name'=>$role_name));
    }

    /**
     * 修改后台人员个人信息
     */
    public function actionEditManagerInfo(){
        $arrJson = ['errCode' => 202,'errMsg'  => '网络错误，请稍候重试。。。','data'    => []];
        $data = Yii::$app->request->post();
        $id = (int)YII::$app->user->id;
        $admin =  Admin::findIdentity($id);
        if($admin){
            $admin->user_telephone = $data['user_telephone'];
            $admin->user_wechat = $data['user_wechat'];
            $admin->user_qq = $data['user_qq'];
            if ($admin->save(false)) {
                $arrJson['errCode'] = 201;
                $arrJson['errMsg'] = '管理员成功修改个人信息。。。';
            }
        }
        return json_encode($arrJson);
    }

    /**
     * 后台用户重置密码页面
     */
    public function actionManagerPwd(){
        return $this->render('manager-pwd',array());
    }

    /**
     * 修改后台人员个人密码
     */
    public function actionEditManagerPwd(){
        $arrJson = ['errCode' => 202,'errMsg'  => '网络错误，请稍候重试。。。','data'    => []];
        $data = Yii::$app->request->post();
        $id = (int)YII::$app->user->id;
        $admin = Admin::findIdentity($id);
        if($admin->validatePassword($data['old_password'])){
            if($data['password'] == $data['confirm_password']){
                $newPass = Yii::$app->getSecurity()->generatePasswordHash($data['password']);
                $connection = \Yii::$app->db;
                $r = $connection->createCommand()->update('yd_admin', ['password_hash' => $newPass], 'id='.$id)->execute();
                if($r){
                    $arrJson['errCode'] = 201;
                    $arrJson['errMsg'] = '密码修改成功...';
                }
            }else{
                $arrJson['errMsg'] = '两次密码填写不一致...';
            }
        }else{
            $arrJson['errMsg'] = '旧密码填写错误...';
        }

        return json_encode($arrJson);
    }

    /**
     * 前台客户列表
     * @return [type] [description]
     */
    public function actionCustomer(){
        return $this->render('customer');
    }

    /**
     * 获取前台客户人员数据
     */
    public function actionGetCustomerList(){
        return true;
    }

}
