<?php

namespace app\modules\organization\controllers;

use Yii;
use app\modules\organization\models\Organization;
use app\modules\organization\models\search\OrganizationSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\catalog\models\Catalog;
use app\modules\rbac\models\AuthItem;
use app\actions\DeleteAction;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends MyController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
            ],
        ];
    }

    /**
     * Lists all Organization models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'regions' => Yii::$app->current->defaultValue(Catalog::getAllForLists(1)),
            'regionAreas' => Yii::$app->current->defaultValue(Catalog::getAllForLists(2)),
            'cities' => Yii::$app->current->defaultValue(Catalog::getAllForLists(3)),
            'roles' => Yii::$app->current->defaultValue(AuthItem::getRoles()),
        ]);
    }

    /**
     * Displays a single Organization model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'regions' => Catalog::getAllForLists(1),
            'regionAreas' => Catalog::getAllForLists(2),
            'cities' => Catalog::getAllForLists(3),
            'streets' => Catalog::getAllForLists(4),
        ]);
    }

    /**
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organization;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
                'roles' => AuthItem::getRoles(),
            ]);
        }
    }

    /**
     * Updates an existing Organization model.
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
                'roles' => AuthItem::getRoles(),
            ]);
        }
    }

    /**
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}