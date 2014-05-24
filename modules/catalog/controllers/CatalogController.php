<?php

namespace app\modules\catalog\controllers;

use dosamigos\editable\EditableAction;
use Yii;
use app\modules\catalog\models\Catalog;
use app\modules\catalog\models\search\CatalogSearch;
use app\Components\MyController;
use yii\db\Exception;
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

    public function actions()
    {
        return [
            'editable' => [
                'class' => EditableAction::className(),
                'modelClass' => Catalog::className(),
                'forceCreate' => false
            ]
        ];
    }

    /**
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionCommon($type)
    {
        $searchModel = new CatalogSearch;
        $searchModel->types = [$type];
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('common', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'title' => $searchModel->getCommon($type),
            'type' => $type,
        ]);
    }

    /**
     * Lists all Catalog models.
     * @return mixed
     */
    public function actionOrganization($type)
    {
        $searchModel = new CatalogSearch;
        $searchModel->organization = true;
        $searchModel->types = [$type];
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('organization', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'title' => $searchModel->getOrganization($type),
            'organizations' => Yii::$app->current->filterDefaultValue(Organization::getAllForLists()),
            'type' => $type,
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
            $model->type = (int) Yii::$app->request->getQueryParam('type_id', 0);
            return $this->render('create', [
                'model' => $model,
                'type' => $type == 'common' ? : 'organization',
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
            $editable = Yii::$app->request->getQueryParam('editable', '') !== '' ?
                Yii::$app->request->getQueryParam('editable') : Yii::$app->session->get('catalogEditable');
            $nameM = Yii::$app->request->getQueryParam('nameM', null);
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            if ($type) {
                $searchModel->types = [$searchModel::getCommonData($type, 0)];
                Yii::$app->session->set('catalogTypes', $searchModel->types);
                Yii::$app->session->set('catalogEditable', $editable);
            } else if ($nameM !== null) {
                $searchModel->types = Yii::$app->session->get('catalogTypes');
                $searchModel->nameM = $nameM;
                Yii::$app->session->set('catalogName', $nameM);
            } else if ($id) {
                try {
                    $catalog = Catalog::find()->where('id = :id')->params([':id' => $id])->one();
                    $catalog->delete();
                } catch (Exception $e) {
                    Yii::$app->debugger->exception($e, 'continue');
                }
                $searchModel->types = Yii::$app->session->get('catalogTypes');
                $searchModel->nameM = Yii::$app->session->get('catalogName');
            }
            $dataProvider = $searchModel->search([]);
            if ($editable) {
                $model = new Catalog;
                $types = Yii::$app->session->get('catalogTypes');
                $model->type = $types[0];
            } else {
                $model = null;
            }
            return $this->renderAjax('modal',
                [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                ]
            );
        } else {
            throw new MethodNotAllowedHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

    public function actionGetList()
    {
        if (Yii::$app->request->isAjax) {
            $type = Yii::$app->request->getQueryParam('type', '');
            if ($type && ($data = Catalog::getAllForLists(Catalog::getCommonData($type, 0)))) {
                $response = [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                    'data' => $data,
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'msg' => 'Произошла ошибка!!!',
                ];
            }
            exit(json_encode($response));
        } else {
            throw new MethodNotAllowedHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

    public function actionModalCreate()
    {
        if (Yii::$app->request->isAjax) {
            $model = new Catalog;
            $model->name = Yii::$app->request->getQueryParam('name', '');
            $model->type = (int) Yii::$app->request->getQueryParam('type', 0);
            $model->status = 1;
            if ($model->save() && ($data = Catalog::getAllForLists($model->type))) {
                $response = [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                    'data' => $data,
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'msg' => 'Произошла ошибка!!!',
                ];
            }
            exit(json_encode($response));
        } else {
            throw new MethodNotAllowedHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

}