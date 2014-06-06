<?php

namespace app\modules\recipient\controllers;

use Yii;
use app\modules\recipient\models\PRE;
use app\modules\recipient\models\POST;
use app\Components\MyController;
use app\modules\catalog\models\Personal;
use app\modules\catalog\models\CompPrep;
use app\modules\waybill\models\Body;
use app\modules\catalog\models\Catalog;
use app\modules\recipient\models\MH;
use app\modules\bloodstorage\models\search\BloodStorageSearch;

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
        $searchModel = new BloodStorageSearch;
        $searchModel->type = 1;
        $kks = $searchModel->search(Yii::$app->request->getQueryParams());
        $searchModel->type = 2;
        $pks = $searchModel->search(Yii::$app->request->getQueryParams());
        $columns = unserialize(Yii::$app->getRequest()->getCookies()->getValue('columns'));
        return $this->render('create', [
            'pre' => $pre,
            'indicationsTransfusion' => $pre->getIndicationsTransfusion(),
            'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
            'generalConditions' => $pre->getGeneralConditions(),
            'skins' => $pre->getSkins(),
            'answers' => Yii::$app->current->defaultValue(Yii::$app->current->getAnswers(), false),
            'statements' => Catalog::getAllForLists(12,
                    Yii::$app->getRequest()->getCookies()->getValue('organizationId')),
            'post' => $post,
            'methodsTransfusion' => $post->getMethodsTransfusion(),
            'reactions' => $post->getReactions(),
            'typesTransfusion' => $post->getTypesTransfusion(),
            'errors' => $errors,
            'kks' => $kks,
            'pks' => $pks,
            'searchModel' => $searchModel,
            'body' => new Body,
            'mh' => new MH,
            'bloodGroups' => Yii::$app->current->getBloodGroup(null, true),
            'rhFactors' => Yii::$app->current->getRhFactor(null, true),
            'kksList' => Yii::$app->current->defaultValue(CompPrep::getAllForLists(1), true),
            'pksList' => Yii::$app->current->defaultValue(CompPrep::getAllForLists(2), true),
            'typesSend' => Yii::$app->current->defaultValue($searchModel->getTypesSend(), true),
            'departments' => Yii::$app->current->defaultValue(Catalog::getAllForLists(10,
                    Yii::$app->getRequest()->getCookies()->getValue('organizationId')), true),
            'columns' => isset($columns['kkpk']['recipient']) ?
                    (strpos($columns['kkpk']['recipient'], ',') !== false ?
                        explode(',', $columns['kkpk']['recipient']) :
                        [$columns['kkpk']['recipient']]) : null,
        ]);
    }

}