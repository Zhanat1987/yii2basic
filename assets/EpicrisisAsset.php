<?php

namespace app\assets;

use yii\web\AssetBundle;

class EpicrisisAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/epicrisis.css',
    ];
    public $js = [
        'myfiles/js/epicrisis.js',
    ];

}