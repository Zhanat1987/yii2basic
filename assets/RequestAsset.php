<?php

namespace app\assets;

use yii\web\AssetBundle;

class RequestAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/request.css',
    ];
    public $js = [
        'myfiles/js/request.js',
    ];

}