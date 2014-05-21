<?php

namespace app\assets;

use yii\web\AssetBundle;

class CatalogModalAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $js = [
        'myfiles/js/catalogModal.js',
    ];

}