<?php

namespace app\modules\recipient\controllers;

use Yii;
use app\modules\recipient\models\PRE;
use app\modules\recipient\models\POST;
use app\Components\MyController;
use app\modules\catalog\models\Personal;

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
            'post' => $post,
            'errors' => $errors,
        ]);
    }

}