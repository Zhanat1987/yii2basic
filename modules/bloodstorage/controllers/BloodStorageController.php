<?php

namespace app\modules\bloodstorage\controllers;

use Yii;
use app\modules\bloodstorage\models\search\BloodStorageSearch;
use app\components\MyController;

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
        $request = Yii::$app->request;
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

        return $this->render('index', [
            'kks' => $kks,
            'pks' => $pks,
            'searchModel' => $searchModel,
        ]);
    }

}