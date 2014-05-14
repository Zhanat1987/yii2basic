<?php

namespace app\assets;

use yii\web\AssetBundle;

class JQueryUIAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';

    public $css = [
        'js/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css',
    ];

    public $js = [
//        'js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}