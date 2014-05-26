<?php

namespace app\assets;

use yii\web\AssetBundle;

class PersonalAsset extends AssetBundle
{

    public $basePath = '@cloudroot';
    public $baseUrl = '@cloud';
    public $js = [
        'myfiles/js/personal.js',
    ];

}