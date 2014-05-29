<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'Info Blood',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'homeUrl' => '/user/deny/index',
    'defaultRoute' => '/user/deny/index',
    'layoutPath' => '@app/layouts',
    'language' => 'ru-RU',
	'modules' => [
        'user' => [
            'class' => 'app\modules\user\User',
        ],
        'rbac' => [
            'class' => 'app\modules\rbac\Rbac',
        ],
        'catalog' => [
            'class' => 'app\modules\catalog\Catalog',
        ],
        'organization' => [
            'class' => 'app\modules\organization\Organization',
        ],
        'request' => [
            'class' => 'app\modules\request\Request',
        ],
        'waybill' => [
            'class' => 'app\modules\waybill\Waybill',
        ],
        'bloodstorage' => [
            'class' => 'app\modules\bloodstorage\BloodStorage',
        ],
    ],
    'components' => [
        'debugger' => function () {
            return new \app\myhelpers\Debugger;
        },
        'current' => [
            'class' => 'app\myhelpers\Current',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/allow/login'],
        ],
        'authManager' => [
            'class' => 'app\modules\rbac\components\Manager',
            'defaultRoles' => ['guest', 'пользователь'],
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@mail',
            'useFileTransport' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'user/allow/error',
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => '/user/deny/index',
                'login' => '/user/allow/login',
                'logout' => '/user/deny/logout',
                'profile' => '/user/deny/profile',
                'profile-edit' => '/user/deny/profile-edit',
                'reset-password' => '/user/allow/reset-password',
                '/catalog/catalog/<type:\d+>/create' => '/catalog/catalog/create',
                '/catalog/catalog/<action:(common|organization)>/<type:\d+>' => '/catalog/catalog/<action>',
                '<module:\w+>/<controller:\w+>/<action:(update|view|delete)>/<id:\d+>' =>
                    '<module>/<controller>/<action>',
            ],
        ],
//        'assetManager' => [
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    // https://github.com/yiisoft/yii2/blob/master/docs/guide/
//                    // output-assets.md#overriding-asset-bundles
//                    // https://github.com/yiisoft/yii2/blob/master/docs/guide/output-assets.md
//                    'sourcePath' => null,
//                    'js' => [
////                        'http://' . $_SERVER["HTTP_HOST"] . '/cloud/js/jquery/jquery-2.0.3.min.js'
//                        'http://' . $_SERVER["HTTP_HOST"] . '/cloud/myfiles/js/jquery-yii2.js'
//                    ],
//                ],
//            ],
//        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'common' => 'common.php',
//                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
