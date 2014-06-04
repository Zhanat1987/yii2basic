<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Personal extends Widget
{

    public $model, $data, $width, $width2;
    public $attribute = 'personal';

    public function run()
    {
        $modelName = basename(get_class($this->model));
        $name      = $modelName . '[' . $this->attribute . ']';
        $id        = lcfirst($modelName) . '-' . $this->attribute;
        return $this->render('personal', [
            'data'   => $this->data,
            'name'   => $name,
            'id'     => $id,
            'value'  => $this->model->personal,
            'label'  => $this->model->getAttributeLabel($this->attribute),
            'width'  => $this->width,
            'width2' => $this->width2,
        ]);
    }

} 