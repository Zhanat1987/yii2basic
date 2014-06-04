<?php

namespace app\modules\recipient\controllers;

use Yii;
use app\modules\recipient\models\POST;
use app\modules\recipient\models\PRE;
use app\Components\MyController;

/**
 * EpicrisisController implements the CRUD actions for POST and PRE models.
 */
class EpicrisisController extends MyController
{

    public function actionCreate()
    {
        $post = new POST;
        $pre = new PRE;
        $errors = [];

        return $this->render('create', [
            'post' => $post,
            'pre' => $pre,
            'errors' => $errors,
        ]);
    }

}