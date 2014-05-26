<?php

namespace app\modules\rbac\controllers;

use Yii;
use app\modules\rbac\models\AuthItem;
use app\modules\organization\models\Organization;
use app\modules\rbac\models\AuthAssignment;
use app\modules\rbac\models\search\AuthAssignmentSearch;
use app\components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends MyController
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
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthAssignmentSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'authItems' => Yii::$app->current->defaultValue(AuthItem::getAllForLists()),
            'organizations' => Yii::$app->current->defaultValue(Organization::getAllForLists()),
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $organization_id
     * @return mixed
     */
    public function actionView($item_name, $organization_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $organization_id),
            'organizations' => Organization::getAllForLists(),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthAssignment;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'organization_id' => $model->organization_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'organizations' => Organization::getAllForLists(),
                'authItems' => AuthItem::getAllForLists2(),
            ]);
        }
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $organization_id
     * @return mixed
     */
    public function actionUpdate($item_name, $organization_id)
    {
        $model = $this->findModel($item_name, $organization_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'organization_id' => $model->organization_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'organizations' => Organization::getAllForLists(),
                'authItems' => AuthItem::getAllForLists2(),
            ]);
        }
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $organization_id
     * @return mixed
     */
    public function actionDelete($item_name, $organization_id)
    {
        $this->findModel($item_name, $organization_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $organization_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $organization_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'organization_id' => $organization_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
