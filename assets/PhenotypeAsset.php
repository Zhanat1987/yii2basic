<?php

namespace app\assets;

use yii\web\AssetBundle;

class PhenotypeAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $css = [
        'myfiles/css/phenotype.css',
    ];
    public $js = [
        'myfiles/js/phenotype.js',
    ];

}