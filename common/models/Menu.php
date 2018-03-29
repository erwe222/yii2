<?php
namespace common\models;
use Yii;

class Menu extends \yii\db\ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'status', 'sort'], 'integer'],
            [['menu_name', 'status'], 'required'],
            [['menu_name', 'icons', 'url'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'pid'        => '上级分类',
            'menu_name'  => '栏目名称',
            'icons'      => '图标',
            'url'        => '访问地址',
            'status'     => '状态',
            'sort'       => '排序字段',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
    
    /**
      * 保存数据前进行操作
      * @return boolean
      */
    public function beforeSave($insert) {
       if ($this->isNewRecord) {
          $this->created_at = date("Y-m-d H:i:s");
        } else {
          $this->updated_at = date("Y-m-d H:i:s");
        }
        return true;
    }

    // 修改之后
    public function afterSave($insert, $changedAttributes) {
        $this->clearNavigationCache();
        return true;
    }

    public function getMenuRecord(){
        $arrAuth = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->id);
        $parents = self::find()->select(['id','pid', 'menu_name','url','icons','sort'])->where(['status' => 1])->indexBy('id')->asArray()->orderBy('pid asc,sort asc')->all();
        $menu_arr = [];
        foreach ($parents as $key => $_val) {
            #判断是否是父级菜单
            if($_val['pid'] == 0){
                $menu_arr [$key] = $_val;
                $menu_arr [$key]['items'] = [];
            }else{
                if(array_key_exists($_val['pid'], $parents)){
                    if(array_key_exists($_val['pid'], $menu_arr)){
                        $menu_arr[$_val['pid']]['items'][$_val['url']] = $_val;
                        continue;
                    }
                    $menu_arr[$_val['pid']] = $parents[$_val['pid']];
                }
            }
        }
        return $menu_arr;
    }

    /**
     * 获取菜单栏缓存标记
     * @return string
     */
    public function getNavCacheFlag(){
        return 'menu_nav_'.Yii::$app->user->id.'_user';
    }
    
    public function getNavCacheAllFlag(){
        return 'menu_nav_all_user';
    }

    public function getNavigation(){
        $cache = Yii::$app->cache;
        $index = $this->getNavCacheFlag();
        $cache_arr = $cache->get($index);
        if($cache_arr){
            return $cache_arr;
        }else{
            return $this->setNavigation();
        }
    }

    public function setNavigation(){
        $cache = Yii::$app->cache;
        $all_index = $this->getNavCacheAllFlag();
        $arr = $cache->get($all_index);
        if(!$arr){$arr = [];}
        $index = $this->getNavCacheFlag();
        if(!in_array($index, $arr)){
            array_push($arr,$index);
            $cache->set($all_index,$arr);
        }
        $index = $this->getNavCacheFlag();
        if ($cache->get($index)) $cache->delete($index);
        $menu_arr = $this->getMenuRecord();
        $cache->set($index, $menu_arr,60*60*6);
        return $menu_arr;
    }

    public function clearNavigationCache(){
        $cache = Yii::$app->cache;
        $all_index = $this->getNavCacheAllFlag();
        $arr = $cache->get($all_index);
        if(count($arr) > 0){
           foreach($arr as $v){
               if ($cache->get($v)) $cache->delete($v);
           }
        }
        $cache->set($all_index,[]);
        return true;
    }

}
