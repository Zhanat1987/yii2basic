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
        $searchModel = new BloodStorageSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

}