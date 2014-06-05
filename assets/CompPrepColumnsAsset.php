<?php

namespace app\assets;

use yii\web\AssetBundle;

class CompPrepColumnsAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/compPrepColumns.css',
    ];
    public $js = [
        'myfiles/js/compPrepColumns.js',
    ];

}