<?php
namespace common\models;
use Yii;

class AuthItem extends \yii\db\ActiveRecord {

    const T_ROLE = 1;   //角色
    const T_POWER = 2;  //权限
   
    //定义场景
    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_DELETE = 'delete';
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            #['name', 'match', 'pattern' => '/^([a-zA-Z0-9_-]|([a-zA-z0-9_-]\\/[0-9_-a-zA-z]))+$/'],
            ['name', 'string', 'min' => 3, 'max' => 64],
            ['name', 'validatePermission'],
            ['description', 'string', 'min' => 1, 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'          =>   '名称',
            'type'          =>   '类型',
            'description'   =>   '说明',
            'created_at'    =>   '创建时间',
            'updated_at'    =>   '修改时间'
        ];
    }
    
    public function validatePermission()
    {
        if (!$this->hasErrors()) {
            $auth = Yii::$app->getAuthManager();
            if ($this->isNewRecord && $auth->getPermission($this->name)) {
                $this->addError('name','This name already exists.');
            }
            if ($this->isNewRecord && $auth->getRole($this->name)) {
                $this->addError('name','This name already exists.');
            }
        }
    }
    
    /**
     * 添加权限
     * @return boolean
     */
    public function createPermission()
    {
        if ($this->validate()) {
            $auth = Yii::$app->getAuthManager();
            $permission = $auth->createPermission($this->name);
            $permission->description = $this->description;
            $is_true = $auth->add($permission);
            
            /*获取超级管理员角色信息并赋予该权限*/
            /*$admin = $auth->getRole(Yii::$app->params['adminRoleName']);
            if($admin){
                $auth->addChild($admin, $permission);
            }*/
            return $is_true;
        }
        return false;
    }

    /**
     * 更新权限描述信息
     * @param string $name 
     * @return boolean
     */
    public function updatePermission($name)
    {

        $auth = Yii::$app->getAuthManager();
        $permission = $auth->getPermission($name);

        if($permission){
            $permission->description = $this->description;
            return $auth->update($name, $permission);
        }

        return false;
    }

    /**
     * 添加角色信息
     */
    public function createRole()
    {
        if ($this->validate()) {
            $auth = Yii::$app->getAuthManager();
            $role = $auth->createRole($this->name);
            $role->description = $this->description;;
            if ($auth->add($role)) {
                return true;
            }
        }
        return false;
    }
    
    /*
     * 修改角色信息
     * @param string $name 角色名
     */
    public function updateRole($name,$description)
    {
        $auth = Yii::$app->getAuthManager();
        $role = $auth->getRole($name);
        if($role){
            $role->description = $description;
            if ($auth->update($name, $role)) {
                return true;
            }
        }
        return false;
    }

    /*
     * 修改角色权限
     * @param string $name 角色名
     * @param array $permissions 角色权限
     */
    public function updateRolePermissions($name, $permissions)
    {
        $auth = Yii::$app->getAuthManager();
        $role = $auth->getRole($name);
        if($role && (count($auth->getPermissionsByRole($name)) ==0 || $auth->removeChildren($role))){
            if(count($permissions) > 0){
                foreach ($permissions as $value) {
                    $rule = $auth->getPermission($value);
                    if($rule){
                        $auth->addChild($role,$rule);
                    }
                }
                return true;
            }else{
                return true;
            }
        }
        return false;
    }

    /**
     * 删除权限
     */
    public function removePermissions($permissions) {
        $auth = Yii::$app->getAuthManager();
        if(count($permissions) > 0){
            foreach ($permissions as $route) {
                try {
                    $item = $auth->getPermission($route);
                    if($item){
                       $auth->remove($item);
                    }
                } catch (Exception $exc) {
                    Yii::error($exc->getMessage(), __METHOD__);
                    return false;
                }
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * 删除角色
     */
    public function removeRole($roleName){
        $auth = Yii::$app->getAuthManager();
        $role = $auth->getRole($roleName);
        if($role !== null){
            #获取角色的所有权限
            $permissions = $auth->getPermissionsByRole($roleName);
            foreach($permissions as $permission) {
                #删除角色拥有的权限
                $auth->removeChild($role, $permission);
            }
            $isTrue = $auth->remove($role);
            if($isTrue){
                return true;
            }
        }
        return false;
    }
}
