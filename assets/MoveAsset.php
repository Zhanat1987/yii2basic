<?php

namespace app\assets;

use yii\web\AssetBundle;

class MoveAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/move.css',
    ];
    public $js = [
        'myfiles/js/move.js',
    ];
    public $depends = [
        'app\assets\CloudAsset',
    ];

}