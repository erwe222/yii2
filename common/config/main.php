<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'true',     //  就是这里了
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'db' => require(__DIR__ . '/../../common/config/localhost_db.php'),


    ],
];
