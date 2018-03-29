<?php
namespace seller\widgets;
use yii\base\Widget;
class BreadcrumbWidget extends Widget{
    
    public $navarr = [];

    public function run()
    {
            $str = '<p class="layui-breadcrumb" style="border:1px solid #5FB878;height:30px;line-height:30px;padding-left:5px;">';
            $str .= "<a href='/'><i class='layui-icon'></i> 首页</a>";
            if(count($this->navarr) > 0){
                foreach ($this->navarr as $value) {
                    if(isset($value['href'])  && !empty($value['href'])){
                        $str .= "<a href='{$value['href']}'>{$value['name']}</a>";
                    }else{
                        $str .= "<a><cite>{$value['name']}</cite></a>";
                    }
                }
            }
            $str .= '<button id="cus-reload-current"  class="layui-btn layui-btn-normal layui-btn-radius" style="height:25px;line-height:25px;margin-top:3px;margin-right:5px;float:right;" >刷新页面</button>';
            return $str .= '</p>';
    }
}
