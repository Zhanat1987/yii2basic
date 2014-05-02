<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'homeUrl' => 'user/default/index',
    'defaultRoute' => 'user/default/index',
    'layoutPath' => '@app/layouts',
	'modules' => [
        'user' => [
            'class' => 'app\modules\user\User',
        ],
        'rbac' => [
            'class' => 'app\modules\rbac\Rbac',
        ],
        'article' => [
            'class' => 'app\modules\article\Article',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@mail',
            'useFileTransport' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'user/default/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
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
