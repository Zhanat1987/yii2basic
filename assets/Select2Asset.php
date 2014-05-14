<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class Select2Asset
 * @package app\assets
 *
 * http://ivaynberg.github.io/select2/
 * file:///C:/xampp/htdocs/yii2.basic2/web/cloud/forms.html
 */
class Select2Asset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';

    public $css = [
        'js/select2/select2.min.css',
    ];

    public $js = [
        'js/select2/select2.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}