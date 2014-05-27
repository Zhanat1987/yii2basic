<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Errors extends Widget
{

    public $errors;

    public function run()
    {
        return $this->render('errors', [
            'errors' => new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->errors))
        ]);
    }

} 