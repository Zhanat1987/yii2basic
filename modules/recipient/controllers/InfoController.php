<?php

namespace app\modules\recipient\controllers;

use Yii;
use app\modules\recipient\models\Info;
use app\modules\recipient\models\search\InfoSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\recipient\models\MH;
use app\modules\recipient\models\MHST;
use app\modules\recipient\models\MHA;
use app\modules\organization\models\Organization;
use app\modules\catalog\models\Personal;
use app\modules\catalog\models\Catalog;
use app\modules\catalog\models\Mkb10;
use app\actions\DeleteAction;
use yii\web\Response;
use yii\web\BadRequestHttpException;

/**
 * InfoController implements the CRUD actions for Info model.
 */
class InfoController extends MyController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Info::className(),
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Info models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Creates a new Info model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Info;
        $mh = new MH;
        $mhst = new MHST;
        $mha = new MHA;
        $errors = [];
//        debug(Yii::$app->request->referrer);
        if (Yii::$app->request->isPost) {
            Yii::$app->cache->delete('recepientCreateData' .
                Yii::$app->getRequest()->getCookies()->getValue('userId'));
            $model->load(Yii::$app->request->post());
            $mh->load(Yii::$app->request->post());
            $mhst->load(Yii::$app->request->post());
            $mha->load(Yii::$app->request->post());
            if (!$model->validate()) {
                $errors[] = $model->getErrors();
            }
            if (!$mh->validate()) {
                $errors[] = $mh->getErrors();
            }
            if (!$mhst->validate()) {
                $errors[] = $mhst->getErrors();
            }
            if (!$mha->validate()) {
                $errors[] = $mha->getErrors();
            }
            if (!$errors) {
                $model->save();
                $mh->recipient_info_id = $model->id;
                $mh->save();
                $mhst->recipient_medical_history_id = $mh->id;
                $mhst->save();
                $mha->recipient_medical_history_id = $mh->id;
                $mha->save();
                return $this->redirect(['index']);
            }
        } else {
            if (($data = unserialize(Yii::$app->cache->get('recepientCreateData' .
                    Yii::$app->getRequest()->getCookies()->getValue('userId')))) !== false) {
                $model->load($data);
                $mh->load($data);
                $mhst->load($data);
                $mha->load($data);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'genders' => Yii::$app->current->defaultValue($model->getGenders(), false),
            'organizationIds' => Organization::getAllForListsByRole('Поликлиника'),
            'bloodGroups' => Yii::$app->current->getBloodGroup(null, false),
            'rhFactors' => Yii::$app->current->getRhFactor(null, false),
            'answers' => Yii::$app->current->getAnswers(),
            'typesResidence' => Yii::$app->current->defaultValue($model->getTypesResidence(), false),
            'citizenships' => Catalog::getAllForLists(9),
            'citizenshipTitle' => Catalog::getData('citizenship', 1),
            'citizenshipTitleCreate' => Catalog::getData('citizenship', 2),
            'documentTypes' => Catalog::getAllForLists(7),
            'documentTypesTitle' => Catalog::getData('document_types', 1),
            'documentTypesTitleCreate' => Catalog::getData('document_types', 2),
            'documentIssueds' => Catalog::getAllForLists(8),
            'documentIssuedTitle' => Catalog::getData('document_issued', 1),
            'documentIssuedTitleCreate' => Catalog::getData('document_issued', 2),
            'regions' => Catalog::getAllForLists(1),
            'regionAreas' => Catalog::getAllForLists(2),
            'cities' => Catalog::getAllForLists(3),
            'streets' => Catalog::getAllForLists(4),
            'regionTitle' => Catalog::getData('region_id', 1),
            'regionAreaTitle' => Catalog::getData('region_area_id', 1),
            'cityTitle' => Catalog::getData('city_id', 1),
            'streetTitle' => Catalog::getData('street_id', 1),
            'regionTitleCreate' => Catalog::getData('region_id', 2),
            'regionAreaTitleCreate' => Catalog::getData('region_area_id', 2),
            'cityTitleCreate' => Catalog::getData('city_id', 2),
            'streetTitleCreate' => Catalog::getData('street_id', 2),
            'mh' => $mh,
            'mkb10' => Yii::$app->current->defaultValue(Mkb10::getAllForLists(), false),
            'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
            'treatmentOutcomes' => Catalog::getAllForLists(6),
            'treatmentOutcomeTitle' => Catalog::getData('treatment_outcome', 1),
            'mhst' => $mhst,
            'mhstOrganizations' => Yii::$app->current->defaultValue(Organization::getAllForLists(), false),
            'mha' => $mha,
            'mhaResults' => $mha->getResults(),
            'errors' => $errors,
        ]);
    }

    /**
     * Updates an existing Info model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Info model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Info the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Info::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCurrentData()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $data = Yii::$app->request->getQueryParam('data', null);
            if ($data) {
                parse_str($data, $v);
                if (Yii::$app->cache->set('recepientCreateData' .
                    Yii::$app->getRequest()->getCookies()->getValue('userId'), serialize($v), 86400)) {
                    return [
                        'status' => 'ok',
                        'msg' => 'Все ништяк!!!',
                    ];
                }
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