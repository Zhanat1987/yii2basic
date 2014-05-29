<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Request extends Widget
{

    public $value, $label;

    public function run()
    {
        return $this->render('request', [
            'value' => $this->value,
            'label' => $this->label,
        ]);
    }

} 