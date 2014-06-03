<?php

namespace app\modules\bloodstorage\controllers;

use Yii;
use app\modules\bloodstorage\models\search\BloodStorageSearch;
use app\components\MyController;
use app\modules\catalog\models\CompPrep;
use app\modules\waybill\models\Body;
use app\modules\catalog\models\Catalog;
use app\modules\recipient\models\MH;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use app\modules\bloodstorage\models\BloodStorage;

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

    public function actionReturn()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            if ($id && BloodStorage::returnToBloodStorage($id)) {
                return [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                ];
            }
            return [
                'status' => 'error',
                'msg' => 'Произошла ошибка!!!',
            ];
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

    public function actionMove()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            $type = (int) Yii::$app->request->getQueryParam('type', 0);
            $spravochnik = (int) Yii::$app->request->getQueryParam('spravochnik', 0);
            $date = Yii::$app->request->getQueryParam('date', '');
            $count = (int) Yii::$app->request->getQueryParam('count', 1);
            if ($id && BloodStorage::move($id, $type, $spravochnik, $date, $count)) {
                return [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                ];
            }
            return [
                'status' => 'error',
                'msg' => 'Произошла ошибка!!!',
            ];
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

}