<?php
namespace seller\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class LeftMenuWidget extends Widget{

    //默认菜单二维数组
    public $defaultMenuArr = [
        [
            'first_menu'=>'自营店管理',
            'href'=>'classify/menu',
            'two_menu'  =>[
                [
                    'name'=>'分类模块管理',
                    'href'=>'classify/menu',
                ],
                [
                    'name'=>'添加商品',
                    'href'=>'',
                ],
            ],
        ],
        [
            'first_menu'=>'我的信息1',
            'href'=>'classify/menu',
            'two_menu'  =>[
                [
                    'name'=>'修改密码',
                    'href'=>'xclassify/menu',
                ],
                [
                    'name'=>'修改个人信息',
                    'href'=>'sclassify/menu',
                ]
            ],
        ],
        [
            'first_menu'=>'控制台管理',
            'two_menu'  =>[
                [
                    'name'=>'系统信息',
                    'href'=>'console/system-info',
                ]
            ],
        ],
    ];
    
    //自定义二维数组
    public $menuArr = [];
    
    public function run(){
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
            $open_class = $this->getOpenMenu($_v['two_menu']);
            $str .= "<li class='layui-nav-item {$open_class}'>";
            $str .= "<a class='' href='javascript:;'>{$_v['first_menu']}</a>";
                if(count($_v['two_menu']) > 0){
                    $str .= '<dl class="layui-nav-child">';
                        foreach($_v['two_menu'] as $_key => $_val){
                           $_href = empty($_val['href']) ? 'javascript:;' : Url::toRoute($_val['href']);
                           $str .= "<dd><a href='{$_href}'>{$_val['name']}</a></dd>";
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
            $str = !empty($_v['href'])? trim($_v['href'],'/'):'';
            if(strcasecmp($controller,$str) == 0){
                return 'layui-nav-itemed';
            }
        }
        return '';
    }
}
