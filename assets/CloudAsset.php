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
        'js/bootstrap-daterangepicker/daterangepicker-bs3.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
        'myfiles/css/cloud.css',
    ];

    public $js = [
        'js/jquery/jquery-2.0.3.min.js',
        'js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js',
        'bootstrap-dist/js/bootstrap.min.js',
        'js/bootstrap-daterangepicker/moment.min.js',
        'js/bootstrap-daterangepicker/daterangepicker.min.js',
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