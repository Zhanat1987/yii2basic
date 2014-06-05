<?php

namespace app\modules\recipient\controllers;

use Yii;
use app\modules\recipient\models\PRE;
use app\modules\recipient\models\POST;
use app\Components\MyController;
use app\modules\catalog\models\Personal;
use app\modules\catalog\models\Catalog;
use app\modules\catalog\models\CompPrep;

/**
 * EpicrisisController implements the CRUD actions for POST and PRE models.
 */
class EpicrisisController extends MyController
{

    public function actionCreate()
    {
        $pre = new PRE;
        $post = new POST;
        $errors = [];

        return $this->render('create', [
            'pre' => $pre,
            'indicationsTransfusion' => $pre->getIndicationsTransfusion(),
            'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
            'generalConditions' => $pre->getGeneralConditions(),
            'skins' => $pre->getSkins(),
            'answers' => Yii::$app->current->defaultValue(Yii::$app->current->getAnswers(), false),
            'statements' => Catalog::getAllForLists(12,
                    Yii::$app->getRequest()->getCookies()->getValue('organizationId')),
            'kks' => Yii::$app->current->defaultValue(CompPrep::getAllForLists(1), false),
            'post' => $post,
            'errors' => $errors,
        ]);
    }

}