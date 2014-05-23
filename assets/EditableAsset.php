<?php

namespace app\assets;

use yii\web\AssetBundle;

class EditableAsset extends AssetBundle
{

    public $basePath = '@cloudroot/editable/';
    public $baseUrl = '@cloud/editable/';

    public $css = [
//        'js/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css',
    ];

    public $js = [
        'bootstrap-editable.js',
        'dosamigos-editable.column.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}