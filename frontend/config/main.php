<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'test' => ['class'=>'frontend\modules\test\TestModule'],
        'job' => ['class'=>'frontend\modules\job\JobModule'],
        'staff' => ['class'=> 'frontend\modules\staff\StaffModule'],
        'system' => ['class'=>'frontend\modules\system\SystemModule'],
        'auth' => ['class'=>'frontend\modules\auth\AuthModule'],
        'user' => ['class'=>'frontend\modules\user\UserModule'],
        'client' => ['class'=>'frontend\modules\client\ClientModule'],
        'supplier' => ['class'=>'frontend\modules\supplier\SupplierModule'],
        'notice' => ['class'=>'frontend\modules\notice\NoticeModule'],
        'purchase' => ['class'=>'frontend\modules\purchase\PurchaseAndSaleModule'],
        'recruitment' => ['class'=>'frontend\modules\recruitment\RecruitmentModule'],
        //触屏端
        'touch'=>['class'=>'frontend\modules\touch\TouchModule'],
        //订单
        'sales'=>['class'=>'frontend\modules\sales\SalesModule'],
        'goods' => ['class' => 'frontend\modules\goods\GoodsModule'],
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [],
                    'logFile' => '@runtime/logs/' . date("Ymd") . '/all.log'

                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
