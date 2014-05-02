<?php

namespace app\assets;

use yii\web\AssetBundle;

class ErrorAsset extends AssetBundle
{
    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'css/cloud-admin.css',
        'font-awesome/css/font-awesome.min.css',
        'js/bootstrap-daterangepicker/daterangepicker-bs3.css',
        'js/uniform/css/uniform.default.min.css',
        'css/animatecss/animate.min.css',
        'myfiles/css/fonts_googleapis.css',
    ];
    public $js = [
        'js/jquery/jquery-2.0.3.min.js',
        'js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js',
        'bootstrap-dist/js/bootstrap.min.js',
        'js/uniform/jquery.uniform.min.js',
        'js/script.js',
        'myfiles/js/error.js',
    ];
}