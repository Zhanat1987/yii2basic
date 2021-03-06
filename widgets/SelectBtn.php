<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class SelectBtn extends Widget
{

    public $model,
        $attribute,
        $data,
        $options,
        $modal,
        $title,
        $titleCreate,
        $editable,
        $width,
        $width2;

    public function run()
    {
        $modelName = basename(get_class($this->model));
        $name      = $modelName . '[' . $this->attribute . ']';
        $id        = lcfirst($modelName) . '-' . $this->attribute;
        $options   = '';
        if ($this->options) {
            foreach ($this->options as $k => $v) {
                $options .= ' ' . $k . '="' . $v . '"';
            }
        }
        return $this->render('select-btn', [
            'entity'      => $this->attribute,
            'data'        => $this->data,
            'options'     => $options,
            'name'        => $name,
            'id'          => $id,
            'value'       => $this->model->{$this->attribute},
            'label'       => $this->model->getAttributeLabel($this->attribute),
            'modal'       => $this->modal,
            'title'       => $this->title,
            'titleCreate' => $this->titleCreate,
            'editable'    => $this->editable,
            'width'       => $this->width,
            'width2'      => $this->width2,
        ]);
    }

} 