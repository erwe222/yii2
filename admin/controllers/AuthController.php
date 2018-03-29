<?php
namespace admin\controllers;
use Yii;
use yii\filters\AccessControl;
use common\models\AdminApiClass;
use common\models\UserApiClass;

class AuthController extends CController{
    
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [['allow' => true,'roles' => ['@']]],
            ],
            'verbs' => [
                 'class' => \yii\filters\VerbFilter::className(),
                 'actions' => [
                     'menu-list'=>['GET'],
                     'menu-data-list' => ['POST'],
                     'manager-data-list'=>['POST']
                 ],
            ]
        ];
    }
    
    /**
     * 菜单管理页面
     */
    public function actionMenuPage(){
        return $this->render('menu-page');
    }
    
    /**
     * 菜单管理列表数据
     */
    public function actionMenuDataList(){
        $page_index         = Yii::$app->request->post('page',1);
        $page_size          = Yii::$app->request->post('limit',20);
        $where              = Yii::$app->request->post('where',[]);
        $status             = isset($where['status']) && !empty($where['status'])? $where['status']:'all';
        $menu_name          = isset($where['menu_name']) && !empty($where['menu_name'])? $where['menu_name']:'';
        $res = AdminApiClass::getInstance()->getMenuList([
            'page_index'=>$page_index,
            'page_size'=>$page_size,
            'status'=>$status,
            'menu_name'=>$menu_name,
        ]);
        $array = array('code'=>0,'msg'=>'','count'=>$res['data']['toatl_num'],'data'=>$res['data']['infos']);
        return $this->asJson($array);
    }
    
    /**
     * 权限管理页面
     */
    public function actionRoutePage(){
        return $this->render('route-page');
    }
    
    /**
     * 删除菜单信息
     */
    public function actionDeleteMenuInfo(){
        $menus              = Yii::$app->request->post('menus',[]);
        
        $res = AdminApiClass::getInstance()->deleteMenuInfo(['menus'=>$menus]);
        return $this->asJson($res);
    }
    
    /**
     * 获取路由列表数据
     * @return type
     */
    public function actionRouteDataList(){
        $page_index         = Yii::$app->request->post('page',1);
        $page_size          = Yii::$app->request->post('limit',20);
        $query_where        = Yii::$app->request->post('where',[]);
        $where = [];
        if(isset($query_where['description'])){
            $where['description'] = addslashes($query_where['description']);
        }
        if(isset($query_where['name'])){
            $where['name'] = addslashes($query_where['name']);
        }
        $res = AdminApiClass::getInstance()->getRouteList([
            'page_index'  => $page_index,
            'page_size'   => $page_size,
            'where'       => $where,
            'orderBy'     => '',
            'sort'        => ''
        ]);
        
        $array = array('code'=>0,'msg'=>'','count'=>$res['data']['toatl_num'],'data'=>$res['data']['infos']);
        return $this->asJson($array);
    }
    
    /**
     * 获取添加路由权限的窗口
     */
    public function actionGetRouteBox(){
        $route_name = Yii::$app->request->get('route_name','');
        $res = AdminApiClass::getInstance()->getRouteInfo(['name'=>$route_name]);
        $isAdd = true; 
        $route_info = [];

        if($res['code'] == 200 && count($res['data']) > 0 ){
            $route_info = $res['data'];
            $isAdd = false;
        }
        return $this->renderPartial('add-route-box',[
            'route_info'=>$route_info,
            'is_add'    =>$isAdd
        ]);
    }
    
    /**
     * 修改路由信息
     */
    public function actionChangeRouteInfo(){
        $name           = Yii::$app->request->post('name','');
        $description    = Yii::$app->request->post('description','');
        $flag           = Yii::$app->request->post('flag','add');

        $res = [];

        if(empty($name) || empty($description)){
            $this->returnData($code = 200,$data = [] ,$flag== 'add'?'权限信息添加失败':'权限信息修改失败',$res = false);
        }

        $params = ['name'=>$name,'description'=>$description];
        if($flag == 'add'){
            $res = AdminApiClass::getInstance()->insertRouteInfo($params);
        }else{
            $res = AdminApiClass::getInstance()->editRouteInfo($params);
        }

        return $this->asJson($res);
    }
    
    /**
     * 删除路由信息
     */
    public function actionDeleteRouteInfo(){
        $routes = Yii::$app->getRequest()->post('routes', []);
        if(count($routes) > 0){
            $res = AdminApiClass::getInstance()->deteleRouteInfo(['routes'=>$routes]);
        }else{
            $res = $this->returnData(301, [], '参数错误', false);
        }
        $this->asJson($res);
    }
    
    /**
     * 角色管理页面
     */
    public function actionRolePage(){
        
        return $this->render('role-page');
    }
    
    /**
     * 获取角色列表数据
     * @return type
     */
    public function actionRoleDataList(){
        $page_index         = Yii::$app->request->post('page',1);
        $page_size          = Yii::$app->request->post('limit',20);
        $query_where        = Yii::$app->request->post('where',[]);
        $where = [];
        if(isset($query_where['name'])){
            $where['name'] = addslashes($query_where['name']);
        }
        $res = AdminApiClass::getInstance()->getRoleList([
            'page_index'  => $page_index,
            'page_size'   => $page_size,
            'where'       => $where,
            'orderBy'     => '',
            'sort'        => ''
        ]);

        $array = array('code'=>0,'msg'=>'','count'=>$res['data']['toatl_num'],'data'=>$res['data']['infos']);
        return $this->asJson($array);
    }
    
    /**
     * 获取角色编辑表单
     */
    public function actionGetRoleBox(){
        $role_name = Yii::$app->request->get('role_name','');
        $res = AdminApiClass::getInstance()->getRoleInfo(['name'=>$role_name]);
        $isAdd = true; 
        $role_info = [];

        if($res['code'] == 200 && count($res['data']) > 0 ){
            $role_info = $res['data'];
            $isAdd = false;
        }
        return $this->renderPartial('add-role-box',[
            'role_info'=>$role_info,
            'is_add'    =>$isAdd
        ]);
    }
    
    /**
     * 修改角色信息
     */
    public function actionChangeRoleInfo(){
        $name           = Yii::$app->request->post('name','');
        $description    = Yii::$app->request->post('description','');
        $flag           = Yii::$app->request->post('flag','add');

        $res = [];

        if(empty($name) || empty($description)){
            $this->returnData($code = 200,$data = [] ,$flag== 'add'?'角色信息添加失败':'角色信息修改失败',$res = false);
        }

        $params = ['name'=>$name,'description'=>$description];
        if($flag == 'add'){
            $res = AdminApiClass::getInstance()->insertRoleInfo($params);
        }else{
            $res = AdminApiClass::getInstance()->editRoleInfo($params);
        }

        return $this->asJson($res);
    }
    
    /**
     * 删除角色信息
     */
    public function actionDeleteRoleInfo(){
        $role_name = Yii::$app->getRequest()->post('name','');
        if(!empty($role_name)){
            $res = AdminApiClass::getInstance()->deteleRoleInfo(['name'=>$role_name]);
        }else{
            $res = $this->returnData(301, [], '参数错误', false);
        }
        $this->asJson($res);
    }
    
    /**
     * 
     */
    public function actionGetEditRoleRouteBox(){
        $role_name = checkNull('role_name', '超级管理员');
        $res = [];
        if(!empty($role_name)){
            $res = AdminApiClass::getInstance()->getRoleRouteList(['name'=>$role_name]);
        }

        return $this->render('edit-roleroute-box',[
            'rules'=>$res['data']['rules'],'role_rules'=>$res['data']['role_rules'],'name'=>$role_name
        ]);
    }
    
    public function actionChangeRoleRoute(){
        $role_name  = Yii::$app->getRequest()->post('name','');
        $routes     = Yii::$app->getRequest()->post('routes',[]);
        
        $res = AdminApiClass::getInstance()->editRoleRoute(['name'=>$role_name,'routes'=>$routes]);
        $this->asJson($res);
    }
    
    /**
     * 前台会员页面
     */
    public function actionUserPage(){
        return $this->render('user-page');
    }
    
    /**
     * 前台会员数据列表
     */
    public function actionUsesDataList(){
        $page_index         = Yii::$app->request->post('page',1);
        $page_size          = Yii::$app->request->post('limit',20);
        $query_where        = Yii::$app->request->post('where',[]);

        $where = [];

        if(isset($query_where['username']) && !empty($query_where['username'])){
            $where['username'] = addslashes($query_where['username']);
        }

        if(isset($query_where['email']) && !empty($query_where['email'])){
            $where['email'] = addslashes($query_where['email']);
        }

        $status             = isset($query_where['status'])? $query_where['status']:'all';
        if($status !== 'all' && $status !=''){
            $where['status'] = $status;
        }

        $res = UserApiClass::getInstance()->getUserList([
            'page_index'  => $page_index,
            'page_size'   => $page_size,
            'where'       => $where,
            'orderBy'     => '',
            'sort'        => ''
        ]);

        $array = array('code'=>0,'msg'=>'','count'=>$res['data']['toatl_num'],'data'=>$res['data']['infos']);
        return $this->asJson($array);
    }
    
    /**
     * 商家人员列表页面
     */
    public function actionSellerPage(){
        return $this->render('seller-page');
    }
    
    /**
     * 商家人员数据列表
     */
    public function actionSellerDataList(){
        
    }
    
    /**
     * 管理人员列表页面
     */
    public function actionManagerPage(){
        return $this->render('manager-page');
    }
    
    /**
     * 管理人员数据列表
     */
    public function actionManagerDataList(){
        $page_index         = Yii::$app->request->post('page',1);
        $page_size          = Yii::$app->request->post('limit',20);
        $query_where        = Yii::$app->request->post('where',[]);

        $where = [];

        if(isset($query_where['username']) && !empty($query_where['username'])){
            $where['username'] = addslashes($query_where['username']);
        }

        if(isset($query_where['email']) && !empty($query_where['email'])){
            $where['email'] = addslashes($query_where['email']);
        }

        $status             = isset($query_where['status'])? $query_where['status']:'all';
        if($status !== 'all' && $status !=''){
            $where['status'] = $status;
        }

        $res = AdminApiClass::getInstance()->getManagerList([
            'page_index'  => $page_index,
            'page_size'   => $page_size,
            'where'       => $where,
            'orderBy'     => '',
            'sort'        => ''
        ]);

        $array = array('code'=>0,'msg'=>'','count'=>$res['data']['toatl_num'],'data'=>$res['data']['infos']);
        return $this->asJson($array);
    }

    /**
     * 修改管理员状态
     */
    public function actionChangeManagerStatus(){
        $status         = Yii::$app->request->post('status','');
        $user_id        = Yii::$app->request->post('user_id',0);
        $res = AdminApiClass::getInstance()->changeManagerInfo([
            'id'        => $user_id,
            'status'    => $status,
        ]);
        return $this->asJson($res);
    }
    
    /**
     * 获取添加菜单的窗口
     */
    public function actionGetMenuBox(){
        $menu_id = (int)Yii::$app->request->get('menu_id',0);
        if($menu_id != 0){
            $res1 = AdminApiClass::getInstance()->getMenuList(['page_index'=>1,'page_size'=>1,'id'=>$menu_id]);
            $menu_info = isset($res1['data']['infos'][0])?$res1['data']['infos'][0]:[];
        }else{
            $menu_info = [];
        }
        $res2 = AdminApiClass::getInstance()->getMenuList(['page_index'=>1,'page_size'=>100,'pid'=>0]);
        
        $menu_array = $res2['data']['infos'];
        return $this->renderPartial('add-menu-box',[
            'menu_info'=>$menu_info,
            'menu_array'=>$menu_array
        ]);
    }

    /**
     * 修改菜单的窗口
     */
    public function actionChangeMenuInfo(){
        $data = Yii::$app->request->post();
        $params = [];
        $params['id'] = Yii::$app->request->post('id',0);
        if(isset($data['pid'])){$params['pid'] = $data['pid'];}
        if(isset($data['url'])){$params['url'] = $data['url'];}
        if(isset($data['status'])){$params['status'] = (int)$data['status'];}
        if(isset($data['sort'])){$params['sort'] = $data['sort'];}
        if(isset($data['menu_name'])){$params['menu_name'] = $data['menu_name'];}
        $res2 = AdminApiClass::getInstance()->editMenuInfo($params);
        return $this->asJson($res2);
    }

    /**
     * 获取添加管理人员窗口
     */
    public function actionGetManagerBox(){
        return $this->renderPartial('add-manager-box');
    }
    
    /**
     * 添加管理员入口
     */
    public function actionAddManagerInfo(){
        $username           = checkNull('username','');
        $email              = checkNull('email','');
        $password           = checkNull('password','');
        $password2          = checkNull('password2','');
        $status             = checkNull('status',10);

        if(empty($username) || empty($password) || empty($password2)){
            return $this->asJson($this->returnData(301, [],'参数错误',false));
        }else if($password != $password2){
            return $this->asJson($this->returnData(304, [],'确认密码输入错误',false));
        }
        $res = AdminApiClass::getInstance()->insertManagerInfo([
            'username'  =>$username,
            'email'     =>$email,
            'password'  =>$password,
            'status'    =>$status
        ]);
        return $this->asJson($res);
    }
    
    public function actionChangeUserStatus(){
        $status         = Yii::$app->request->post('status','');
        $user_id        = Yii::$app->request->post('user_id',0);
        $res = UserApiClass::getInstance()->changeUserInfo([
            'id'        => $user_id,
            'status'    => $status,
        ]);
        return $this->asJson($res);
    }
    
    public function actionGetRoutesBox(){
        return $this->renderPartial('edit-roleroutes-box');
    }
    
    
}
