<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use backend\models\AuthItem;
use backend\components\Helper;
class RoleController extends CController{

    /*
     *禁用yii2的Csrf提交验证 
     *(1)第一种解决办法是关闭Csrf
     *$enableCsrfValidation = false;
     *
     *(2)第二种解决办法是在form表单中加入隐藏域
     *<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
     *
     *(3)第三种解决办法是在AJAX中加入_csrf字段
     *var csrfToken = $('meta[name="csrf-token"]').attr("content");
     * $.ajax({type: 'POST',url: url,data: {_csrf:csrfToken},success: success,dataType: dataType});
     */
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionGetRoleList(){
        $search_params = $this->query();
        $query = AuthItem::find()->where(['type' =>1]);
        if(count($search_params['where']) > 0){
            if(isset($search_params['where']['name'])){
                $query->andWhere(['like', 'name', $search_params['where']['name']]);
            }
        }
        $conunt = (int)$query->count();
        $orderby = isset($search_params['orderBy']) && $search_params['orderBy'] == 'id'?'created_at':$search_params['orderBy'];
        $order_by[$orderby] = $search_params['sort'];
        $route_array = $query->offset($search_params['offset'])->limit($search_params['limit'])->orderBy($order_by)->asArray()->all();
        $filter_totel = count($route_array);

        #服务端返回的JSON数据如下所示。其中sEcho是请求次数，data是表格中的数据。iTotalDisplayRecords是过滤后的数据总数，iTotalRecords是原始数据总数。
        $array = array(
            'iTotalDisplayRecords'=>$conunt,
            'iTotalRecords'=>$filter_totel,
            'sEcho'=>$search_params['echo'],
            'data'=>$route_array,
        );

        return Json::encode($array);
    }

    /**
     * 角色添加
     * @return json
     */
    public function actionCreate(){
        $arrJson = ['errCode' => 202,'errMsg'  => '角色添加失败，请稍候重试。。。','data'    => []];
        $array = Yii::$app->request->post();
        if($array){
            $auth_item = new AuthItem();
            if($auth_item->load(['params' => $array], 'params')){
                $is_true = $auth_item->createRole();
                if($is_true){
                    $arrJson['errMsg'] = "角色[{$auth_item->name}]添加成功...";
                    $arrJson['errCode'] = 201;
                }else{
                    $arrJson['errMsg'] = "[{$auth_item->name}]角色已存在...";
                }
            }
            return json_encode($arrJson);
        }
        
    }

    /**
     * 角色更新
     */
    public function actionUpdate(){
        $arrJson = ['errCode' => 202,'errMsg'  => '角色更新失败，请稍候重试。。。','data'    => []];
        $data = Yii::$app->request->post();
        if($data){
            $auth_item = new AuthItem();
            $is_true = $auth_item->updateRole($data['name'],$data['description']);
            if($is_true){
                $arrJson['errMsg'] = "角色[{$data['name']}]修改信息成功...";
                $arrJson['errCode'] = 201;
            }else{
                $arrJson['errMsg'] = "[{$data['name']}]角色更新失败...";
            }
        }
        return json_encode($arrJson);
    }

    /**
     * 角色删除
     */
    public function actionDelete(){
        $arrJson = ['errCode' => 202,'errMsg'  => '角色删除失败，请稍候重试。。。','data'    => []];
        $data = Yii::$app->request->post();
        if($data){
            $auth_item = new AuthItem();
            $is_true = $auth_item->removeRole($data['name']);
            if($is_true){
                $arrJson['errMsg'] = "[{$data['name']}]角色成功删除...";
                $arrJson['errCode'] = 201;
            }else{
                $arrJson['errMsg'] = "[{$data['name']}]角色不存在...";
            }
        }
        return json_encode($arrJson);
    }

    /**
     * 编辑角色权限页面
     */
    public function actionEditRole(){
        $name = Yii::$app->request->get('name','');
        $manager = Yii::$app->authManager;
        if(!empty($name)){
            $role = $manager->getRole($name);
            if($role){
                $role_rules = $manager->getPermissionsByRole($name);
                $rules = AuthItem::find()->where(['type' =>2])->asArray()->indexBy('name')->all();
            }
        }
        return $this->render('editrole',array('rules'=>$rules,'role_rules'=>$role_rules,'name'=>$name));
    }

    /**
     * 修改角色路由权限
     * @return [type] [description]
     */
    public function actionEditRoleRoute(){
        $data = Yii::$app->request->post();
        $auth_item = new AuthItem();
        $auth_item->updateRolePermissions($data['name'],$data['routes']);
        $this->redirect('edit-role?name='.$data['name']);
    }
}
