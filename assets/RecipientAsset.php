<?php

namespace app\assets;

use yii\web\AssetBundle;

class RecipientAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/recipient.css',
    ];
    public $js = [
        'myfiles/js/recipient.js',
    ];

}