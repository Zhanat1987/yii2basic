<?php

namespace app\modules\organization\controllers;

use app\components\MyController;

class DefaultController extends MyController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
