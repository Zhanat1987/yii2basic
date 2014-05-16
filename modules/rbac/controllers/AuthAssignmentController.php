<?php

namespace app\modules\rbac\controllers;

use app\modules\rbac\models\AuthItem;
use app\modules\user\models\User;
use Yii;
use app\modules\rbac\models\AuthAssignment;
use app\modules\rbac\models\search\AuthAssignmentSearch;
use app\components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\myhelpers\Debugger;

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

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Debugger::debug(Yii::$app->controller->module->id);
            Debugger::debug(Yii::$app->controller->id);
            Debugger::debug(Yii::$app->controller->action->id);
            $userId = Yii::$app->user->identity->getId();
            $permissionName = Yii::$app->controller->module->id . '-' .
                Yii::$app->controller->id . '-' . Yii::$app->controller->action->id;
            $can = Yii::$app->authManager->checkAccess($userId, $permissionName);
            Debugger::debug($can);
//            Debugger::debug(Yii::$app->controller->getModules());
            return true;
        } else {
            return false;
        }
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
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
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
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'users' => User::getAllForLists(),
                'authItems' => AuthItem::getAllForLists(),
            ]);
        }
    }

    /*
     * public static function getAllForLists()
    {
        if (($data = unserialize(Yii::$app->cache->get('all-users'))) === false) {
            $data = [];
            $models = self::find()->asArray()->select(['id, username'])->where(
                ['status' => 10, 'role' => 10])->all();
            if ($models) {
                foreach ($models as $model) {
                    $data[$model['id']] = $model['username'];
                }
            }
            Yii::$app->cache->set('all-users', serialize($data));
        }
        return $data;
    }
     */

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users' => User::getAllForLists(),
                'authItems' => AuthItem::getAllForLists(),
            ]);
        }
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionDelete($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
