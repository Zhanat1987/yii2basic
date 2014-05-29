<?php

namespace app\assets;

use yii\web\AssetBundle;

class WaybillAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/waybill.css',
    ];
    public $js = [
        'myfiles/js/waybill.js',
    ];

}