<?php

namespace app\modules\catalog\controllers;

use Yii;
use app\modules\catalog\models\Catalog;
use app\modules\catalog\models\search\CatalogSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\organization\models\Organization;
use yii\web\MethodNotAllowedHttpException;

/**
 * CatalogController implements the CRUD actions for Catalog model.
 */
class CatalogController extends MyController
{

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
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionCommon()
    {
        $searchModel = new CatalogSearch;
        $searchModel->types = array_keys($searchModel->getCommon());
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('common', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'common' => Yii::$app->current->filterDefaultValue($searchModel->getCommon()),
        ]);
    }

    /**
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionOrganization()
    {
        $searchModel = new CatalogSearch;
        $searchModel->organization = true;
        $searchModel->types = array_keys($searchModel->getOrganization());
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('organization', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'organization' => Yii::$app->current->filterDefaultValue($searchModel->getOrganization()),
            'organizations' => Yii::$app->current->filterDefaultValue(Organization::getAllForLists()),
        ]);
    }

    /**
     * Displays a single Catalog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'types' => $model->organization_id ? $model->getOrganization() : $model->getCommon(),
            'organizations' => $model->organization_id ? Organization::getAllForLists() : null,
        ]);
    }

    /**
     * Creates a new Catalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catalog;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $type = Yii::$app->request->getQueryParam('type', 'common');
            return $this->render('create', [
                'model' => $model,
                'type' => $type == 'common' ? : 'organization',
                'types' => $type == 'common' ? $model->getCommon() : $model->getOrganization(),
                'organizations' => $type == 'organization' ? Organization::getAllForLists() : null,
            ]);
        }
    }

    /**
     * Updates an existing Catalog model.
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
                'type' => $model->organization_id ? 'organization' : 'common',
                'types' => $model->organization_id ? $model->getOrganization() : $model->getCommon(),
                'organizations' => $model->organization_id ? Organization::getAllForLists() : null,
            ]);
        }
    }

    /**
     * Deletes an existing Catalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionModal()
    {
        if (Yii::$app->request->isAjax) {
            $searchModel = new CatalogSearch;
            $type = Yii::$app->request->getQueryParam('type', '');
            if ($type) {
                $searchModel->types = [$searchModel::getCommonData($type, 0)];
                Yii::$app->session->set('catalogTypes', $searchModel->types);
            } else {
                $searchModel->types = Yii::$app->session->get('catalogTypes');
                $searchModel->nameM = Yii::$app->request->getQueryParam('name', '');
            }
            $dataProvider = $searchModel->search([]);
            return $this->renderAjax('modal',
                [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                ]
            );
        } else {
            throw new MethodNotAllowedHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

}