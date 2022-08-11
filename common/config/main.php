<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'Asia/Shanghai',
    'language' => 'zh-CN',
    'charset' => 'utf-8',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*小程序*/
        'wxSmallProgram' => [
            'class' => 'common\kjlib\weixinSmallprogram\wxSmallProgram',
            'appId' => '****',
            'appSecret' => '***',
        ],
    ],
];
