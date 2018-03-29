<?php
namespace admin\widgets;
use Yii;
use yii\base\Widget;
class BreadcrumbWidget extends Widget{
    
    public $navarr = [];

    public function run()
    {
        $controller = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
        $menus = \common\models\AdminApiClass::getInstance()->getAdministratorMenuList();
        $menus['data']['infos'];
        
        foreach ($menus['data']['infos'] as $_val) {
            if(count($_val['items']) > 0){
                foreach ($_val['items'] as $key=>$value) {
                    if($key == $controller){
                        $this->navarr = [
                            ['name'=>$_val['menu_name'],'href'=>''],
                            ['name'=>$value['menu_name'],'href'=>''],
                        ];
                        goto end;
                    }
                }
            }
        }
        
        end:

        $str = '<p class="layui-breadcrumb" style="border:1px seashell #5FB878;height:30px;line-height:30px;padding-left:5px;">';
        $str .= "<a href='/'><i class='layui-icon'></i> 首页</a>";
        if(count($this->navarr) > 0){
            $str .= "<a href='javascript:;'>{$this->navarr[0]['name']}</a>";
            $str .= "<a><cite>{$this->navarr[1]['name']}</cite></a>";
        }
        $str .= '<button id="cus-reload-current"  class="layui-btn layui-btn-normal layui-btn-radius" style="height:25px;line-height:25px;margin-top:3px;margin-right:5px;float:right;" >刷新页面</button>';
        return $str .= '</p>';
    }
}
