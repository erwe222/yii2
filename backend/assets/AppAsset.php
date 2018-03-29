<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
 
    public $css = [
        '/assets/public/static/h-ui/css/H-ui.min.css',
        '/assets/public/static/h-ui.admin/css/H-ui.admin.css',
        '/assets/lib/Hui-iconfont/1.0.8/iconfont.css',
        '/assets/public/static/h-ui.admin/css/style.css',
        '/assets/public/static/h-ui.admin/skin/default/skin.css',
        '/assets/lib/icheck/icheck.css',
        '/assets/public/css/style.css',
        '/assets/lib/layui/css/layui.css',
    ];
    
    
    public $js = [
        
        '/assets/public/static/h-ui/js/H-ui.js',
        '/assets/public/static/h-ui.admin/js/H-ui.admin.page.js',
        '/assets/lib/My97DatePicker/4.8/WdatePicker.js',
        '/assets/lib/datatables/jquery.dataTables.min.js',
        '/assets/lib/laypage/1.2/laypage.js',
        '/assets/lib/icheck/jquery.icheck.min.js',
        '/assets/lib/jquery.validation/1.14.0/jquery.validate.js',
        '/assets/lib/jquery.validation/1.14.0/validate-methods.js',
        '/assets/lib/jquery.validation/1.14.0/messages_zh.js',
        '/assets/lib/layer/2.4/layer.js',
        '/assets/lib/layui/layui.js',
        '/assets/public/js/jquery.extended.js',
        '/assets/public/js/datatable.public.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    
    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {  
        $view->registerJsFile($jsfile, [AppAsset::className(), "depends" => "backend\assets\AppAsset"]);  
    }
    
    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {  
        $view->registerCssFile($cssfile, [AppAsset::className(), "depends" => "backend\assets\AppAsset"]);  
    } 
}