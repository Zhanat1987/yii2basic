<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Personal extends Widget
{

    public $model, $data;

    public function run()
    {
        $modelName = basename(get_class($this->model));
        $name      = $modelName . '[personal]';
        $id        = lcfirst($modelName) . '-personal';
        return $this->render('personal', [
            'data'        => $this->data,
            'name'        => $name,
            'id'          => $id,
            'value'       => $this->model->personal,
            'label'       => $this->model->getAttributeLabel('personal'),
        ]);
    }

} 