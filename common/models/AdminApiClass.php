<?php
namespace common\models;

use Yii;
use common\models\Admin;
use common\models\AuthItem;
use common\models\Menu;
use common\models\Route;
use common\models\ActionLog;
use common\models\AdminSignupForm;

class AdminApiClass extends ApiClass{

    /**
     * 静态变量保存全局实例
     */
    private static $_instance = null;
    
    /**
     * 私有构造函数，防止外界实例化对象
     */
    private function __construct() {
    }

    /**
     * 私有克隆函数，防止外办克隆对象
     */
    private function __clone() {
        
    }

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
     * 管理员注册接口
     */
    public function setAdminReg($params){
        $checkRes = $this->verifyParams(['username'=>'require|alpha','password'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $res = Admin::find()->where(['username'=>$params['username']])->asArray()->one();
        if($res){
            return $this->returnData(302,$res,"该用户[{$res['username']}]已被注册");
        }
        
        $user = new Admin();
        $user->username = $params['username'];
        $user->setPassword($params['password']);
        $user->generateAuthKey();
        $user->status = Seller::STATUS_ACTIVE;
        if($user->save()){
            return $this->returnData(200,$user,'注册成功',TRUE);
        }
        return $this->returnData(304,[],'注册失败',false);
    }
    
    /**
     * 用户登录验证
     */
    public function checkAdminLogin($params){
        $checkRes = $this->verifyParams(['username'=>'require','password'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }
        
        $res = Admin::find()->where(['username'=>$params['username']])->one();
        if(!$res){
            return $this->returnData(302,[],"该用户[{$params['username']}]不存在");
        }

        if(!$res->validatePassword($params['password'])){
            return $this->returnData(303,[],"该用户[{$res['username']}]密码错误");
        }

        if($res['status'] != Admin::STATUS_ACTIVE){
            return $this->returnData(304,[],"该用户[{$res['username']}]已被锁定");
        }

        return $this->returnData(200,$res,"",true);
    }

    /**
     * 获取菜单列表
     * @param type $params
     * @return type
     */
    public function getMenuList($params){
        $where = [];
        
        if(isset($params['id']) && !empty($params['id'])){
           $where['id'] = (int)$params['id'];
        }
        
        if(isset($params['pid'])){
           $where['pid'] = (int)$params['pid'];
        }
        
        if(isset($params['status']) && !empty($params['status']) && $params['status'] != 'all'){
           $where['status'] = (int)$params['status'];
        }
        if(isset($params['menu_name']) && !empty($params['menu_name'])){
           $where['menu_name'] = addslashes(trim($params['menu_name']));
        }

        $pageindex = isset($params['page_index'])?$params['page_index']:1;
        $pagesize  = isset($params['page_size'])?$params['page_size']:0;
        $orderBy   = isset($params['orderBy'])?$params['orderBy']:'created_at';
        $sort      = isset($params['sort'])?$params['sort']:'desc';

        $sql = 'select *,IFNULL((select menu_name FROM yd_menu B where B.id = A.pid),"顶级分栏") as parent_name from yd_menu A where 1=1';
        
        if(isset($where['id'])){
            $sql  .= ' AND A.id ='.$where['id'];
        }
        
        if(isset($where['pid'])){
            $sql  .= ' AND A.pid ='.$where['pid'];
        }
        
        if(isset($where['status'])){
            $sql  .= ' AND A.status ='.$where['status'];
        }
        
        if(isset($where['menu_name'])){
            $sql  .= " AND A.menu_name like '%{$where['menu_name']}%'";
        }
        
        $conunt    = Menu::findBySql($sql)->count();

        $resArr    = $this->getPageNum($conunt,$pageindex,$pagesize == 0 ? $conunt : $pagesize);

        $sql      .= " order by {$orderBy} {$sort} limit {$resArr['offset']},{$resArr['limit']}";
        
        $array = Menu::findBySql($sql)->asArray()->all();

        return $this->returnData(200,[
            'infos' =>$array,
            'offset' => $resArr['offset'],
            'limit' => $resArr['limit'],
            'toatl_num' => $conunt,
            'page_index' => $pageindex,
            'page_num' => $pagesize,
        ],"",true);
    }

    /**
     * 获取权限列表数据
     */
    public function getRouteList($params){
        $pageindex = isset($params['page_index'])?$params['page_index']:1;
        $pagesize  = isset($params['page_size'])?$params['page_size']:0;
        $orderBy   = isset($params['orderBy'])?$params['orderBy']:'created_at';
        $sort      = isset($params['sort'])?$params['sort']:'desc';

        $query = AuthItem::find()->where(['type' =>2]);

        if(count($params['where']) > 0){
            if(isset($params['where']['description'])){
                $query->andWhere(['like', 'description', $params['where']['description']]);
            }
            
            if(isset($params['where']['name'])){
                $query->andWhere(['like', 'name', $params['where']['name']]);
            }
        }

        $conunt = (int)$query->count();
        
        $resArr    = $this->getPageNum($conunt,$pageindex,$pagesize == 0 ? $conunt : $pagesize);

        $array = $query->offset($resArr['offset'])->limit($resArr['limit'])->asArray()->all();
        
        return $this->returnData(200,[
            'infos' =>$array,
            'offset' => $resArr['offset'],
            'limit' => $resArr['limit'],
            'toatl_num' => $conunt,
            'page_index' => $pageindex,
            'page_num' => $pagesize,
        ],"",true);
    } 
    
    /**
     * 获取角色列表数据
     */
    public function getRoleList($params){
        $pageindex = isset($params['page_index'])?$params['page_index']:1;
        $pagesize  = isset($params['page_size'])?$params['page_size']:0;
        $orderby   = isset($params['orderBy']) && !empty($params['orderBy'])?$params['orderBy']:'created_at';
        $sort      = isset($params['sort']) && !empty($params['sort'])?$params['sort']:'desc';

        $query = AuthItem::find()->where(['type' =>1]);
        if(isset($params['where']) && count($params['where']) > 0){
            if(isset($params['where']['name'])){
                $query->andWhere(['like', 'name', $params['where']['name']]);
            }
        }
        $conunt = (int)$query->count();
        
        $resArr    = $this->getPageNum($conunt,$pageindex,$pagesize == 0 ? $conunt : $pagesize);

        $array = $query->offset($resArr['offset'])->limit($resArr['limit'])->orderBy([$orderby=>$sort])->asArray()->all();
        
        return $this->returnData(200,[
            'infos' =>$array,
            'offset' => $resArr['offset'],
            'limit' => $resArr['limit'],
            'toatl_num' => $conunt,
            'page_index' => $pageindex,
            'page_num' => $pagesize,
        ],"",true);
    }
    
    /**
     * 获取后台管理人员列表
     */
    public function getManagerList($params){
        $pageindex = isset($params['page_index'])?$params['page_index']:1;
        $pagesize  = isset($params['page_size'])?$params['page_size']:0;
        $orderby   = isset($params['orderBy']) && !empty($params['orderBy'])?$params['orderBy']:'created_at';
        $sort      = isset($params['sort']) && !empty($params['sort'])?$params['sort']:'desc';

        $sql = 'SELECT id,username,email,`status`,created_at,(SELECT item_name from yd_auth_assignment auth where auth.user_id = admin.id LIMIT 1) as role_name from yd_admin admin where 1=1 ';
        if(isset($params['where']['username'])){
            $sql .= " AND admin.username = '{$params['where']['username']}'";
        }
        
        if(isset($params['where']['email'])){
            $sql .= " AND admin.email like '%{$params['where']['email']}%'";
        }
        
        if(isset($params['where']['status'])){
            $sql .= " AND admin.status = {$params['where']['status']}";
        }
        
        
        $conunt = Admin::findBySql($sql)->count();
        $resArr    = $this->getPageNum($conunt,$pageindex,$pagesize == 0 ? $conunt : $pagesize);
        $sql .= " order by {$orderby} {$sort} limit {$resArr['offset']},{$resArr['limit']}";
        $query2 = Admin::findBySql($sql);
        $array = $query2->asArray()->all();
        return $this->returnData(200,[
            'infos' =>$array,
            'offset' => $resArr['offset'],
            'limit' => $resArr['limit'],
            'toatl_num' => $conunt,
            'page_index' => $pageindex,
            'page_num' => $pagesize,
        ],"",true);
    }
    
    /**
     * 添加管理员信息
     */
    public function insertManagerInfo($params){
        $checkRes = $this->verifyParams([
            'username'=>'require|alpha',
            'password'=>'require',
            'status'=>'in:0,10',
            'email'=>'email'
        ], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $model = new AdminSignupForm();
        if ($model->load(['params' => $params], 'params')) {
            if ($model->signup()) {
                return $this->returnData(200,[],"管理员添加成功");
            }
        }
        return $this->returnData(303,[],"管理员添加失败");
    }
    
    /**
     * 修改管理员信息
     */
    public function changeManagerInfo($params){
        $checkRes = $this->verifyParams([
            'id'=>'require|number',
            'status'=>'in:0,10',
        ], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }
        
        $res = Admin::find()->where(['id'=>(int)$params['id']])->one();
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
    
    public function getManagerInfo($params){
        $checkRes = $this->verifyParams(['id'=>'require',], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $res = Admin::find()->where(['id'=>(int)$params['id']])->asArray()->one();
        return $res;
    }
    
    /**
     * 编辑菜单信息
     * @param type $params
     * @return type
     */
    public function editMenuInfo($params){
        $is_add = true;
        if($params['id'] && (int)$params['id'] > 0){#修改
            $is_add = false;
            $res = Menu::find()->where(['id'=>(int)$params['id']])->one();
            if($res == null){
                return $this->returnData(302,[],"菜单修改失败");
            }
        }else{#添加
            $res = new Menu();
        }

        $filter_arr = array('id','created_at');
        foreach($res->attributes as $k=>$v){
            if(!in_array($k, $filter_arr) && isset($params[$k])){
                $res->$k = $params[$k];
            }
        }
        if($res->save(false)){
            return $this->returnData(200,[],$is_add?'菜单添加成功':"菜单修改成功",true);
        }else{
            return $this->returnData(303,[],$is_add?'菜单添加失败':"菜单修改失败");
        }
    }
    
    /**
     * 添加路由信息
     * @param type $params
     * @return type
     */
    public function insertRouteInfo($params){
        $checkRes = $this->verifyParams(['name'=>'require','description'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $auth_item = new AuthItem();
        $auth_item->name = $params['name'];
        $auth_item->description = $params['description'];
        $is_true = $auth_item->createPermission();
        if($is_true){
            return $this->returnData(200,[],"权限信息添加成功",true);
        }
        return $this->returnData(303,[],"权限信息添加失败");
    }
    
    /**
     * 更新路由信息
     * @param type $params
     */
    public function editRouteInfo($params){
        $checkRes = $this->verifyParams(['name'=>'require','description'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }
        
        $auth_item = new AuthItem();
        if($auth_item->load(['params' => $params], 'params')){
            $is_true = $auth_item->updatePermission($params['name']);
            if($is_true){
                return $this->returnData(200,[],"权限信息修改成功",true);
            }
        }
        return $this->returnData(303,[],"权限信息修改失败",false);
    }
    
    /**
     * 删除路由信息
     * @param type $params
     */
    public function deteleRouteInfo($params){
        $checkRes = $this->verifyParams(['routes'=>'require|array'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }
        if(count($params['routes']) > 0){
            $auth_item = new AuthItem();
            $is_true = $auth_item->removePermissions($params['routes']);
            if($is_true){
                return $this->returnData(200,[],"路由删除成功",true);
            }
        }else{
            return $this->returnData(303,[],"路由删除失败");
        }
    }
    
    /**
     * 获取路由信息
     * @param type $params
     * @return type
     */
    public function getRouteInfo($params){
        $checkRes = $this->verifyParams(['name'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $res = AuthItem::find()->where(['type' =>2,'name'=>$params['name']])->asArray()->one();
        return $this->returnData(200,$res,'',true);
    }
    
    /**
     * 获取角色信息
     * @param type $params
     * @return type
     */
    public function getRoleInfo($params){
        $checkRes = $this->verifyParams(['name'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $res = AuthItem::find()->where(['type' =>1,'name'=>$params['name']])->asArray()->one();
        return $this->returnData(200,$res,'',true);
    }
    
    /**
     * 添加角色信息
     * @param type $params
     * @return type
     */
    public function insertRoleInfo($params){
        $checkRes = $this->verifyParams(['name'=>'require','description'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $auth_item = new AuthItem();
        $auth_item->name = $params['name'];
        $auth_item->description = $params['description'];
        $is_true = $auth_item->createRole();
        if($is_true){
            return $this->returnData(200,[],"角色信息添加成功",true);
        }
        return $this->returnData(303,[],"角色信息添加失败");
    }
    
    /**
     * 更新角色信息
     * @param type $params
     */
    public function editRoleInfo($params){
        $checkRes = $this->verifyParams(['name'=>'require','description'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $auth_item = new AuthItem();
        $is_true = $auth_item->updateRole($params['name'],$params['description']);
        
        if($is_true){
            return $this->returnData(200,[],"角色信息修改成功",true);
        }

        return $this->returnData(303,[],"角色信息修改失败");
    }
    
    /**
     * 删除角色信息
     * @param type $params
     * @return type
     */
    public function deteleRoleInfo($params){
        $checkRes = $this->verifyParams(['name'=>'require'], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }
        
        $auth_item = new AuthItem();
        $is_true = $auth_item->removeRole($params['name']);
        if($is_true){
            return $this->returnData(200,[],"角色删除成功",true);
        }
        return $this->returnData(303,[],"角色删除失败");
    }
    
    public function getRoleRouteList($params){
        if (!isset($params['name'])){
            return $this->returnData(301,[],$this->getParamErrTip('name'));
        }
        $rules = [];
        $manager = Yii::$app->authManager;
        if(!empty($params['name'])){
            $role = $manager->getRole($params['name']);
            if($role){
                $role_rules = $manager->getPermissionsByRole($params['name']);
                $rules = AuthItem::find()->where(['type' =>2])->asArray()->indexBy('name')->all();
            }
        }
        
        return $this->returnData(200,[
            'role_rules' =>$role_rules,
            'rules'=>$rules,
            'toatl_num' => count($rules),
        ],"",true);
    }
    
    /**
     * 编辑角色权限
     */
    public function editRoleRoute($params){
        $checkRes = $this->verifyParams([
            'name'  =>'require',
            'routes'=>'array']
        ,$params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $auth_item = new AuthItem();
        $is_true = $auth_item->updateRolePermissions($params['name'],$params['routes']);
        if($is_true){
            return $this->returnData(200,[],"角色权限修改成功",true);
        }
        return $this->returnData(303,[],"角色权限修改失败");
    }
    
    /**
     * 菜单删除操作
     */
    public function deleteMenuInfo($params){
        $checkRes = $this->verifyParams(['menus'=>'require|array',], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }

        $res = Menu::deleteAll(['in', 'id', $params['menus']]);
        if($res){
            return $this->returnData(200,[],"菜单删除成功",true);
        }
        return $this->returnData(303,[],"菜单删除失败");
    }

    /**
     * 获取管理员菜单列表
     */
    public function getAdministratorMenuList(){
        $menu_model = new \common\models\Menu();
        $cache_menu = $menu_model->getNavigation();
        return $this->returnData(200,[
            'infos' =>$cache_menu,
        ],"",true);
    }
    
    /**
     * 修改管理员密码
     */
    public function changeManagerPwd($params){
        $checkRes = $this->verifyParams([
            'id'=>'require|number',
            'old_password'=>'require',
            'password'=>'require',
            'password2'=>'require',
        ], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }
        
        $admin = Admin::findIdentity($params['id']);
        
        if(!$admin->validatePassword($params['old_password'])){
            return $this->returnData(302,[],'旧密码填写错误...',true);
        }
        
        if($params['password'] != $params['password2']){
            return $this->returnData(303,[],'两次密码填写不一致...',true);
        }
        
        $newPass = Yii::$app->getSecurity()->generatePasswordHash($params['password']);
        $connection = \Yii::$app->db;
        $r = $connection->createCommand()->update('{{%admin}}', ['password_hash' => $newPass], 'id='.$params['id'])->execute();
        if($r){
            return $this->returnData(200,[],'密码修改成功...',true);
        }else{
            return $this->returnData(304,[],'密码修改失败...',true);
        }
    }
    
    /**
     * 上传管理员相册图片
     */
    public function uploadManagerAlbum($params){
        $checkRes = $this->verifyParams([
            'id'=>'require|number',
            'files'=>'array'
        ], $params);
        if($checkRes !== true){
            return $this->returnData(301,[],$checkRes);
        }
        
        foreach ($params['files'] as $value) {
            $album = new Album();
            $album->admin_id = $params['id'];
            $album->old_name = $value['old_name'];
            $album->new_name = $value['new_name'];
            $album->save_url = $value['save_url'];
            $album->created_time = time();
            $album->save(false);
        }

        return $this->returnData(200,[],'图片添加成功成功...',true);
    }
    
    /**
     * 获取相册列表
     */
    public function getManagerAlbumList($params){
        $pageindex = isset($params['page_index'])?$params['page_index']:1;
        $pagesize  = isset($params['page_size'])?$params['page_size']:0;
        $orderBy   = isset($params['orderBy'])?$params['orderBy']:'created_time';
        $sort      = isset($params['sort'])?$params['sort']:'asc';

        $sql = 'select * from {{%album}} where admin_id='.$params['admin_id'];
        
        $conunt    = Album::findBySql($sql)->count();

        $resArr    = $this->getPageNum($conunt,$pageindex,$pagesize == 0 ? $conunt : $pagesize);

        $sql      .= " order by {$orderBy} {$sort} limit {$resArr['offset']},{$resArr['limit']}";
        
        $array = Album::findBySql($sql)->asArray()->all();

        return $this->returnData(200,[
            'infos' =>$array,
            'offset' => $resArr['offset'],
            'limit' => $resArr['limit'],
            'toatl_num' => $conunt,
            'page_index' => $pageindex,
            'page_num' => $pagesize,
        ],"",true);
    }

}
