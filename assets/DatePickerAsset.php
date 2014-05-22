<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class DatePickerAsset
 * @package app\assets
 *
 * https://github.com/Eonasdan/bootstrap-datetimepicker
 * http://eonasdan.github.io/bootstrap-datetimepicker/
 */
class DatePickerAsset extends AssetBundle
{

    public $basePath = '@cloudroot/bootstrap-datetimepicker/';
    public $baseUrl = '@cloud/bootstrap-datetimepicker/';

    public $css = [
        'css/bootstrap-datetimepicker.min.css',
    ];

    public $js = [
        'js/moment.min.js',
        'js/bootstrap-datetimepicker.min.js',
        'js/locales/bootstrap-datetimepicker.ru.js',
    ];

}