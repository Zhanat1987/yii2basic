<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Phenotype extends Widget
{

    public $name, $value;

    public function run()
    {
        return $this->render('phenotype', [
            'name' => $this->name,
            'value' => $this->value,
        ]);
    }

} 