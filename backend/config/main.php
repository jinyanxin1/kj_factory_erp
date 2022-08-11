<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'staff' => ['class'=> 'backend\modules\staff\StaffModule'],
        'system' => ['class'=>'backend\modules\system\SystemModule'],
        'auth' => ['class'=>'backend\modules\auth\AuthModule'],
        'user' => ['class'=>'backend\modules\user\UserModule'],
        'client' => ['class'=>'backend\modules\client\ClientModule'],
        'supplier' => ['class'=>'backend\modules\supplier\SupplierModule'],
        //项目管理
        'project' => ['class' => 'backend\modules\project\ProjectModule'],
        'purchase' => ['class' => 'backend\modules\purchase\PurchaseModule'],
        'sales' => ['class' => 'backend\modules\sales\SalesModule'],
        'goods' => ['class' => 'backend\modules\goods\GoodsModule'],
        //财务管理
        'finance' => ['class' => 'backend\modules\finance\FinanceModule'],
        'ware-house' => ['class' => 'backend\modules\wareHouse\WareHouseModule'],
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
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [],
                    'logFile' => '@runtime/logs/' . date("Ymd") . '/all.log'

                ],
                //采购单记录日志
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['purchaseOrder'],
                    'levels' => ['info','error', 'warning'],
                    'logVars' => ['*'],
                    'logFile' => '@runtime/logs/'. date("Ymd") . '/purchaseOrder.log',
                ],
                //销售单日志记录
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['salesOrder'],
                    'levels' => ['info','error', 'warning'],
                    'logVars' => ['*'],
                    'logFile' => '@runtime/logs/'. date("Ymd") . '/salesOrder.log',
                ],
                //统计收支记录日表
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['salesOrder'],
                    'levels' => ['info','error', 'warning'],
                    'logVars' => ['*'],
                    'logFile' => '@runtime/logs/'. date("Ymd") . '/paymentsStaticsDay.log',
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
