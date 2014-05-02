<?php

namespace app\modules\article\controllers;

use Yii;
use app\modules\article\models\Article;
use app\modules\article\models\search\ArticleSearch;
use app\components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\myhelpers\Debugger;
use yii\web\ForbiddenHttpException;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends MyController
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

//    public function beforeAction($action)
//    {
//        if (parent::beforeAction($action)) {
////            Debugger::margin();
////            Debugger::debug(Yii::$app->user->identity);
//            Debugger::debug(Yii::$app->user->identity->rbac_role_name);
//            // "app-backend" - имя модуля по умолчанию в backend'е
//            Debugger::debug(Yii::$app->controller->module->id);
//            Debugger::debug(Yii::$app->controller->id);
//            Debugger::debug(Yii::$app->controller->action->id);
//            $module = Yii::$app->controller->module->id;
//            $controller = Yii::$app->controller->id;
//            $action = Yii::$app->controller->action->id;
//            $userId = Yii::$app->user->identity->getId();
//            $permissionName = $module . '-' . $controller . '-' . $action;
//            if ($action == 'index') {
//                $can = Yii::$app->authManager->checkAccess($userId, $permissionName);
//                Debugger::debug($can);
//            } else if ($action == 'update') {
//                $id = Yii::$app->request->getQueryParam('id', 0);
////                $id = 1;
//                $can = Yii::$app->authManager->checkAccess($userId, $permissionName, ['id' => $id]);
//                $can = Yii::$app->authManager->checkAccess($userId, $permissionName);
//                if (!$can) {
//                    throw new ForbiddenHttpException('Доступ запрещен!!!', 403);
//                }
//                Debugger::debug($id);
//                Debugger::debug($userId);
//                Debugger::debug($permissionName);
//                Debugger::debug($can);
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
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
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
