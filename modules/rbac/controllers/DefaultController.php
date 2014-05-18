<?php

namespace app\modules\rbac\controllers;

use app\components\MyController;
use app\modules\rbac\components\Generator;
use app\modules\rbac\rules\AuthorRule;

class DefaultController extends MyController
{

    public function actionGenerate()
    {
        Generator::execute();
        $this->redirect(\Yii::$app->urlManager->createUrl('/rbac/auth-item/index'));
    }

}