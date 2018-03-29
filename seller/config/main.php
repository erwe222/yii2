<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'seller-app',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'seller\controllers',
    'bootstrap' => ['log'],
    'name'=>'后台管理',
    #模块主题配置
    'modules' => [
        /*
        'gii'=> 'yii\gii\Module',
        "admin" => [        
            "class" => "mdm\admin\Module",   
        ],*/
    ],

    'language' => 'zh-CN',

    #默认访问的控制器(尽量控制器首字母大写和控制器名字一样)
    'defaultRoute' => 'index/index',

    #设置别名
    "aliases" => [    
        #"@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    
    #自定义组件
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Seller',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-seller', 'httpOnly' => true],
            'loginUrl' => ['login/login'],
        ],
        'session' => [
            #这是用于在后台登录的会话cookie的名称
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,//隐藏index.php 
            #'enableStrictParsing' => false,
            #'suffix' => '.html',//后缀，如果设置了此项，那么浏览器地址栏就必须带上.html后缀，否则会报404错误
            'rules' => [
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
         ],
        
        #配置数据链接
        'db' => require(__DIR__ . '/../../common/config/localhost_db.php'),
        
        
        #缓存组件
        'cache' => [
            #'class' => 'yii\caching\FileCache',
          'class' => 'yii\redis\Cache',  //redis接管缓存
        ],
        
        #redis缓存组件
        'redis' => [
           'class' => 'yii\redis\Connection',
           'hostname' => '127.0.0.1',
           'port' => 6379,
           'database' => 0,
        ],

        #通过配置 添加用户自定义 附加行为
        'as myBehavior2' => \backend\components\MyBehavior::className(),

        /*#主题模板配置
        'view' => [
            'theme' => [
            'pathMap' => [                
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'             
                 ],
            ],
        ],*/

        #资源管理修改
        'assetManager' => [
            'bundles' => [
                // 去掉自己的bootstrap 资源
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ],
                // 去掉自己加载的Jquery
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => []
                ],
            ],
        ],
        
        #配置发送邮件组件
        /*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,    //这里一定要改成false，不然邮件不会发送
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.qq.com',
                'username' => '837215079@qq.com',
                'password' => 'flsknstixwcmbfif',        //如果是163邮箱，此处要填授权码
                'port' => '25',
                'encryption' => 'tls',
            ],
        ],
            
         *          
         */

    ],
    'params' => $params,
];
