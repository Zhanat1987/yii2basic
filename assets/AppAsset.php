<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';

    public $css = [
        'myfiles/css/cloud.css',
    ];

    public $js = [
        'js/script.js',
        'myfiles/js/cloud.js',
    ];

}