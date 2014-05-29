<?php

namespace app\modules\catalog\controllers;

use Yii;
use app\modules\catalog\models\Personal;
use app\modules\catalog\models\search\PersonalSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use app\modules\organization\models\Organization;
use app\modules\catalog\models\Catalog;
use app\actions\DeleteAction;
use dosamigos\editable\EditableAction;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * PersonalController implements the CRUD actions for Personal model.
 */
class PersonalController extends MyController
{

    public function actions()
    {
        return [
            'editable' => [
                'class' => EditableAction::className(),
                'modelClass' => Personal::className(),
                'forceCreate' => false
            ],
            'delete' => [
                'class' => DeleteAction::className(),
            ],
        ];
    }

    /**
     * Lists all Personal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonalSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'organizations' => Yii::$app->current->defaultValue(Organization::getAllForLists()),
            'departments' => Yii::$app->current->defaultValue(Catalog::getAllForLists(10)),
        ]);
    }

    /**
     * Displays a single Personal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'organizations' => Organization::getAllForLists(),
            'departments' => Catalog::getAllForLists(10),
        ]);
    }

    /**
     * Creates a new Personal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Personal;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'organizations' => Organization::getAllForLists(),
                'departments' => Catalog::getAllForLists(10),
            ]);
        }
    }

    /**
     * Updates an existing Personal model.
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
                'organizations' => Organization::getAllForLists(),
                'departments' => Catalog::getAllForLists(10, Yii::$app->session->get('organizationId')),
            ]);
        }
    }

    /**
     * Finds the Personal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Personal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionModal()
    {
        if (Yii::$app->request->isAjax) {
            $searchModel = new PersonalSearch;
            if (Yii::$app->request->getQueryParam('filter', '')) {
                $params['PersonalSearch'] = [
                    'surname' => Yii::$app->request->getQueryParam('surname', ''),
                    'name' => Yii::$app->request->getQueryParam('name', ''),
                    'patronimic' => Yii::$app->request->getQueryParam('patronimic', ''),
                    'post' => Yii::$app->request->getQueryParam('post', ''),
                    'department' => Yii::$app->request->getQueryParam('department', ''),
                ];
                Yii::$app->cache->set('personalSearch', serialize($params), 3600);
            } else {
                Yii::$app->cache->delete('personalSearch');
                $params = [];
            }
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            if ($id) {
                try {
                    $personal = Personal::find()->where('id = :id')->params([':id' => $id])->one();
                    $personal->delete();
                } catch (Exception $e) {
                    Yii::$app->debugger->exception($e, 'continue');
                }
                if (Yii::$app->cache->get('personalSearch')) {
                    $params = unserialize(Yii::$app->cache->get('personalSearch'));
                }
            }
            $dataProvider = $searchModel->search($params);
            $model = new Personal;
            return $this->renderAjax('modal',
                [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'params' => $params,
                    'departments' => Catalog::getAllForLists(10, Yii::$app->session->get('organizationId')),
                ]
            );
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

    public function actionGetList()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($data = Personal::getAllForLists()) {
                return [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                    'data' => $data,
                ];
            } else {
                return [
                    'status' => 'error',
                    'msg' => 'Произошла ошибка!!!',
                ];
            }
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

    public function actionModalCreate()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new Personal;
            $model->surname = Yii::$app->request->getQueryParam('surname', '');
            $model->name = Yii::$app->request->getQueryParam('name', '');
            $model->patronimic = Yii::$app->request->getQueryParam('patronimic', '');
            $model->post = Yii::$app->request->getQueryParam('post', '');
            $model->department = Yii::$app->request->getQueryParam('department', '');
            $model->organization_id = Yii::$app->session->get('organizationId');
            $model->status = 1;
            if ($model->save() && ($data = Personal::getAllForLists())) {
                return [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                    'data' => $data,
                ];
            } else {
                return [
                    'status' => 'error',
                    'msg' => 'Произошла ошибка!!!',
                ];
            }
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

}