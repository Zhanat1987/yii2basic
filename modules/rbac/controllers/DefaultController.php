<?php

namespace app\modules\rbac\controllers;

use app\components\MyController;
use app\modules\rbac\rules\AuthorRule;
use app\myhelpers\Debugger;

class DefaultController extends MyController
{
    public function actionIndex()
    {
        Debugger::margin();
        $authorRule = new AuthorRule();
        Debugger::debug(serialize($authorRule));
        return $this->render('index');
    }
}
