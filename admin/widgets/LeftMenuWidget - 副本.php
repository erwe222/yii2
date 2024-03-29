<?php
namespace admin\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class LeftMenuWidget extends Widget{

    //默认菜单二维数组
    public $defaultMenuArr = [];
    
    //自定义二维数组
    public $menuArr = [];
    
    public function run(){
        $menus = \common\models\AdminApiClass::getInstance()->getAdministratorMenuList();
        $this->menuArr = $menus['data']['infos'];
        $tmp_arr = array_merge($this->defaultMenuArr,$this->menuArr);
        if(count($tmp_arr) > 0){
            $lis = $this->getLi($tmp_arr);
            return $this->getBody($lis);
        }
        return '';
    }
    
    
    
    public function getBody($lis){
        $menu_str = '';
        $menu_str .= '<div class="layui-side layui-bg-black">';
            $menu_str .= '<div class="layui-side-scroll">';
                $menu_str .= '<ul class="layui-nav layui-nav-tree"  lay-filter="test">';
                    $menu_str .= $lis;
                $menu_str .= '</ul>';
            $menu_str .= '</div>';
        $menu_str .= '</div>';
        return $menu_str;
    }
    
    public function getLi($tmp_arr){
        $str = '';
        foreach($tmp_arr as $_k => $_v){
            $open_class = $this->getOpenMenu($_v['items']);
            $str .= "<li class='layui-nav-item {$open_class}'>";
            $str .= "<a class='' href='javascript:;'>{$_v['menu_name']}</a>";
                if(count($_v['items']) > 0){
                    $str .= '<dl class="layui-nav-child">';
                        foreach($_v['items'] as $_key => $_val){
                           $_href = empty($_val['url']) ? 'javascript:;' : Url::toRoute($_val['url']);
                           $str .= "<dd><a href='{$_href}'>{$_val['menu_name']}</a></dd>";
                        }
                    $str .= '</dl>';
                }
            $str .= '</li>';
        }
        return $str;
    }

    /**
     * 判断菜单是否打开
     */
    public function getOpenMenu($data){
        $controller = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
        foreach ($data as $_k=>$_v){
            $str = !empty($_v['url'])? trim($_v['url'],'/'):'';
            if(strcasecmp($controller,$str) == 0){
                return 'layui-nav-itemed';
            }
        }
        return '';
    }
}
