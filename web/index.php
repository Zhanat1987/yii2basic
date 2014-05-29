<?php

function debug($v)
{
    echo '<pre style="background-color: #000; color: #fff; font-size: 14px;
                    font-weight: 600; line-height: 18px; margin: 20px;
                    padding: 20px; border: 3px solid #00FF40;  border-radius: 10px;">';
    var_dump($v);
    echo '</pre>';
}

function stop($v)
{
    exit(debug($v));
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../config/aliases.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
