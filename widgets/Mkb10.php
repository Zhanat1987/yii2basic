<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Mkb10 extends Widget
{

    public $model, $data, $width;

    public function run()
    {
        $modelName = basename(get_class($this->model));
        $name      = $modelName . '[mkb10]';
        $id        = lcfirst($modelName) . '-mkb10';
        return $this->render('mkb10', [
            'data'  => $this->data,
            'name'  => $name,
            'id'    => $id,
            'value' => $this->model->mkb10,
            'label' => $this->model->getAttributeLabel('mkb10'),
            'width' => $this->width,
        ]);
    }

} 