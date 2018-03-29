<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',

    'language' => 'zh-CN',
    
    #默认访问的控制器(尽量控制器首字母大写和控制器名字一样)
    'defaultRoute' => 'index/index',
    'modules' => [
        #手机端模块
        'mobile' => [
            'class' => 'frontend\modules\mobile\Module',
        ],
        #微信公众号模块
        'weixin' => [
            'class' => 'frontend\modules\weixin\Module',
        ],
    ],
    'components' => [

        'db' => require(__DIR__ . '/../../common/config/localhost_db.php'),

        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['login/login'],
        ],
        'session' => [
            'name' => 'advanced-frontend',
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
                '<modules:\w+>/<controller:\w+>/<action:\w+>'=>'<modules>/<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
             ],

         ],

        // 'view' => [
        //     'theme' => [
        //         'pathMap' => [
        //           '@app/views' => '@app/themes/basic',
        //           '@app/views' => '@app/views',
        //        ],
        //     ],
        //  ],
    ],
    'params' => $params,
];