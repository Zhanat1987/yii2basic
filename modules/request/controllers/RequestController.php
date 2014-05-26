<?php

namespace app\modules\request\controllers;

use Yii;
use app\modules\request\models\Header;
use app\modules\request\models\search\HeaderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\organization\models\Organization;
use app\modules\catalog\models\Personal;
use app\actions\DeleteAction;
use app\modules\catalog\models\Catalog;

/**
 * RequestController implements the CRUD actions for Header model.
 */
class RequestController extends Controller
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
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Header::className()
            ],
        ];
    }

    /**
     * Lists all Header models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HeaderSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'statuses' => Yii::$app->current->defaultValue($searchModel->getStatuses()),
            'organizations' => Yii::$app->current->defaultValue(
                    Organization::getAllForListsByRole('Центр крови')),
            'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists()),
        ]);
    }

    /**
     * Displays a single Header model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Header model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Header;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'statuses' => Yii::$app->current->getStatuses(),
                'urgency' => $model->getUrgency(),
                'types' => $model->getTypes(),
                'organizations' => Organization::getAllForListsByRole('Центр крови'),
                'targets' => Catalog::getAllForLists(13, Yii::$app->session->get('organizationId')),
                'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
                'targetTitle' => Catalog::getData('target', 1),
                'targetTitleCreate' => Catalog::getData('target', 2),
            ]);
        }
    }

    /**
     * Updates an existing Header model.
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
                'statuses' => Yii::$app->current->getStatuses(),
                'urgency' => $model->getUrgency(),
                'types' => $model->getTypes(),
                'organizations' => Organization::getAllForListsByRole('Центр крови'),
                'targets' => Catalog::getAllForLists(13, Yii::$app->session->get('organizationId')),
                'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
                'targetTitle' => Catalog::getData('target', 1),
                'targetTitleCreate' => Catalog::getData('target', 2),
            ]);
        }
    }

    /**
     * Finds the Header model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Header the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Header::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}