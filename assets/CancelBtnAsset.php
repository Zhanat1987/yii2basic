<?php

namespace app\assets;

use yii\web\AssetBundle;

class CancelBtnAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';

    public $css = [
        'myfiles/css/cancelBtn.css',
    ];
    public $js = [
        'myfiles/js/cancelBtn.js',
    ];

}