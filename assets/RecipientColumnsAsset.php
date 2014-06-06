<?php

namespace app\assets;

use yii\web\AssetBundle;

class RecipientColumnsAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/recipientColumns.css',
    ];
    public $js = [
        'myfiles/js/recipientColumns.js',
    ];

}