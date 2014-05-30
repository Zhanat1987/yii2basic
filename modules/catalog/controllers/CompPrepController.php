<?php

namespace app\modules\catalog\controllers;

use Yii;
use app\modules\catalog\models\CompPrep;
use app\modules\catalog\models\search\CompPrepSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use app\actions\DeleteAction;

/**
 * CompPrepController implements the CRUD actions for CompPrep model.
 */
class CompPrepController extends MyController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => CompPrep::className(),
            ],
        ];
    }

    /**
     * Lists all CompPrep models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompPrepSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'types' => Yii::$app->current->defaultValue($searchModel->getTypes()),
        ]);
    }

    /**
     * Displays a single CompPrep model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'types' => $model->getTypes(),
        ]);
    }

    /**
     * Creates a new CompPrep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompPrep;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'types' => $model->getTypes(),
            ]);
        }
    }

    /**
     * Updates an existing CompPrep model.
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
                'types' => $model->getTypes(),
            ]);
        }
    }

    /**
     * Finds the CompPrep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompPrep the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompPrep::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}