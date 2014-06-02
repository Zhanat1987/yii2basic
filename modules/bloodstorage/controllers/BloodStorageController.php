<?php

namespace app\modules\bloodstorage\controllers;

use Yii;
use app\modules\bloodstorage\models\search\BloodStorageSearch;
use app\components\MyController;
use app\modules\catalog\models\CompPrep;
use app\modules\waybill\models\Body;
use app\modules\catalog\models\Catalog;
use app\modules\recipient\models\MH;

/**
 * BloodStorageController implements the CRUD actions for BloodStorage model.
 */
class BloodStorageController extends MyController
{

    /**
     * Lists all BloodStorage models.
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * _pjax	#w0 - кк
         * _pjax	#w2 - пк
         * BloodStorageSearch[date_s...
         */
        $searchModel = new BloodStorageSearch;
//        $request = Yii::$app->request;
//        $kkParams = [];
//        $pkParams = [];
//        if ($request->isPjax) {
//            Yii::$app->request->getQueryParams()
//        }
        $searchModel->type = 1;
//        $kks = $searchModel->search($kkParams);
        $kks = $searchModel->search(Yii::$app->request->getQueryParams());
        $searchModel->type = 2;
//        $pks = $searchModel->search($pkParams);
        $pks = $searchModel->search(Yii::$app->request->getQueryParams());
//        debug($searchModel->body);
//        debug($searchModel);
//        stop($kks);
        return $this->render('index', [
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
                        Yii::$app->session->get('organizationId')), true),
        ]);
    }

}