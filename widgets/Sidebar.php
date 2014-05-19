<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Sidebar extends Widget
{

    public function run()
    {
        return $this->render('sidebar', [
            'menu' => Yii::$app->current->getSideBarMenu()
        ]);
    }

} 