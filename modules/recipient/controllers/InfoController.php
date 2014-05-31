<?php

namespace app\modules\recipient\controllers;

use Yii;
use app\modules\recipient\models\Info;
use app\modules\recipient\models\search\InfoSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\recipient\models\MH;
use app\modules\recipient\models\MHST;
use app\modules\recipient\models\MHA;
use app\modules\organization\models\Organization;

/**
 * InfoController implements the CRUD actions for Info model.
 */
class InfoController extends MyController
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
     * Lists all Info models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Info model.
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
     * Creates a new Info model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Info;
        $mh = new MH;
        $mhst = new MHST;
        $mha = new MHA;
        if (Yii::$app->request->isPost) {
            debug(Yii::$app->request->post());
            $model->load(Yii::$app->request->post());
            $mh->load(Yii::$app->request->post());
            $mhst->load(Yii::$app->request->post());
            $mha->load(Yii::$app->request->post());
            debug($mha->validate());
            debug($mha->getErrors());
            debug($model->validate());
            debug($model->getErrors());
            $mha->save();
        }
        return $this->render('create', [
            'model' => $model,
            'genders' => Yii::$app->current->defaultValue($model->getGenders(), false),
            'organizationIds' => Organization::getAllForListsByRole('Поликлиника'),
            'bloodGroups' => Yii::$app->current->getBloodGroup(null, false),
            'rhFactors' => Yii::$app->current->getRhFactor(null, false),
            'answers' => Yii::$app->current->defaultValue(Yii::$app->current->getAnswers(), false),
            'typesResidence' => Yii::$app->current->defaultValue($model->getTypesResidence(), false),
            'mh' => $mh,
            'mhst' => $mhst,
            'mhstOrganizations' => Yii::$app->current->defaultValue(Organization::getAllForLists(), false),
            'mha' => $mha,
            'mhaResults' => $mha->getResults(),
        ]);
    }

    /**
     * Updates an existing Info model.
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
     * Deletes an existing Info model.
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
     * Finds the Info model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Info the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Info::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
