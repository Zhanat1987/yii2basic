<?php

namespace app\modules\catalog\controllers;

use Yii;
use app\modules\catalog\models\Personal;
use app\modules\catalog\models\search\PersonalSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\organization\models\Organization;
use app\modules\catalog\models\Catalog;
use app\actions\DeleteAction;

/**
 * PersonalController implements the CRUD actions for Personal model.
 */
class PersonalController extends MyController
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
                'modelClass' => Personal::className()
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
                'departments' => Catalog::getAllForLists(10),
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

}