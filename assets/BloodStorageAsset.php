<?php

namespace app\assets;

use yii\web\AssetBundle;

class BloodStorageAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/bloodstorage.css',
    ];
    public $js = [
        'myfiles/js/bloodstorage.js',
    ];
    public $depends = [
        'yii\widgets\PjaxAsset',
    ];

}