<?php

namespace app\widgets;

use yii\base\Widget;

class BreadCrumbs extends Widget
{

    public function run()
    {
        return $this->render('breadcrumbs');
    }

} 