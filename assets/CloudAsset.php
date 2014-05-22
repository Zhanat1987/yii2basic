<?php

namespace app\assets;

use yii\web\AssetBundle;

class CloudAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';

    public $css = [
        'css/cloud-admin.css',
        'css/themes/default.css',
        'css/responsive.css',
        'font-awesome/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
    ];

    public $js = [
        'js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js',
        'bootstrap-dist/js/bootstrap.min.js',
        'js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js',
        'js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js',
        'js/jQuery-Cookie/jquery.cookie.min.js',
        'js/script.js',
        'myfiles/js/cloud.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

}