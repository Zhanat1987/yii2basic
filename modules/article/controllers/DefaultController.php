<?php

namespace app\modules\article\controllers;

use app\components\MyController;

class DefaultController extends MyController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
