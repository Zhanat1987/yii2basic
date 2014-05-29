<?php

namespace app\modules\waybill\controllers;

use Yii;
use app\modules\waybill\models\Header;
use app\modules\waybill\models\search\HeaderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\organization\models\Organization;
use app\modules\waybill\models\Body;
use yii\db\Exception;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use app\modules\catalog\models\CompPrep;

/**
 * WaybillController implements the CRUD actions for Header model.
 */
class WaybillController extends Controller
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
            'organizations' => Yii::$app->current->defaultValue(
                    Organization::getAllForListsByRole('Стационар')),
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
        $modelKK = new Body;
        $modelKK->type = 1;
        $modelsKK[] = $modelKK;
        $modelPK = clone $modelKK;
        $modelPK->type = 2;
        $modelsPK[] = $modelPK;
        $errors = [];
        $kkValidateError = $pkValidateError = $validKKorPK = '';
        if (Yii::$app->request->isPost) {
            $modelsB = [];
            $post = Yii::$app->request->post();
            $header['Header'] = $post['Header'];
            $body = $post['Body'];
            $pkIndex = 0;
            foreach ($body['type'] as $k => $v) {
                if ($modelKK->isEmpty($body, $v, $k, $pkIndex)) {
                    continue;
                }
                $modelBody = new Body;
                $modelBody->comp_prep_id = $body['comp_prep_id'][$k];
                $modelBody->volume = $body['volume'][$k];
                $modelBody->date_prepare = $body['date_prepare'][$k];
                $modelBody->date_expiration = $body['date_expiration'][$k];
                if ($v == 1) {
                    $modelBody->scenario ='kk';
                    $modelBody->type = 1;
                    $modelBody->blood_group = $body['blood_group'][$k];
                    $modelBody->rh_factor = $body['rh_factor'][$k];
                    $modelBody->phenotype = $body['phenotype'][$k];
                    $modelBody->registration_number = $body['registration_number'][$k];
                    $modelBody->donor = $body['donor'][$k];
                } else if ($v == 2) {
                    $modelBody->scenario ='pk';
                    $modelBody->type = 2;
                    $modelBody->quantity = $body['quantity'][$pkIndex];
                    $modelBody->series = $body['series'][$pkIndex];
                    ++$pkIndex;
                }
                if (!$modelBody->validate()) {
                    if ($v == 1) {
                        if (!$kkValidateError) {
                            $errors[] = Yii::t('common', 'Необходимо заполнить
                                все обязательные поля для Компонентов Крови!!!');
                        }
                        $kkValidateError = true;
                    } else if ($v == 2) {
                        if (!$pkValidateError) {
                            $errors[] = Yii::t('common', 'Необходимо заполнить
                                все обязательные поля для Препаратов Крови!!!');
                        }
                        $pkValidateError = true;
                    }
                } else {
                    $validKKorPK = true;
                }
                if ($v == 1) {
                    $modelsKK[] = $modelBody;
                } else if ($v == 2) {
                    $modelsPK[] = $modelBody;
                }
                $modelsB[] = $modelBody;
            }
            if ($kkValidateError == '' && $pkValidateError == '' && $validKKorPK == '') {
                $errors[] = Yii::t('common', 'Необходимо заполнить
                                все обязательные поля хоты бы для одного
                                Компонента или Препарата Крови!!!');
            }
            $model->load($header);
            if (!$model->validate()) {
                $errors[] = $model->getErrors();
            }
            if (!$model->hasErrors() && $kkValidateError == ''
                && $pkValidateError == '' && $validKKorPK == true
            ) {
                $model->save(false);
                foreach ($modelsB as $modelB) {
                    try {
                        $modelB->waybill_header_id = $model->id;
                        $modelB->save(false);
                    } catch (Exception $e) {
                        Yii::$app->debugger->exception($e);
                    }
                }
                $this->redirect(['index']);
            }
        }
        $modelsKK[] = clone $modelKK;
        $modelsPK[] = clone $modelPK;
        return $this->render('create', [
            'model' => $model,
            'statuses' => Yii::$app->current->getStatuses(),
            'organizations' => Organization::getAllForListsByRole('Центр крови'),
            'modelsKK' => $modelsKK,
            'modelsPK' => $modelsPK,
            'kks' => Yii::$app->current->defaultValue(CompPrep::getAllForLists(1), false),
            'pks' => Yii::$app->current->defaultValue(CompPrep::getAllForLists(2), false),
            'bloodGroups' => Yii::$app->current->getBloodGroup(null, false),
            'rhFactors' => Yii::$app->current->getRhFactor(null, false),
            'labels' => $modelKK->attributeLabels(),
            'errors' => $errors,
        ]);
    }
    public function actionCreate2()
    {
        $model = new Header;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'statuses' => Yii::$app->current->getStatuses(),
                'organizations' => Organization::getAllForListsByRole('Центр крови'),
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
                'organizations' => Organization::getAllForListsByRole('Центр крови'),
            ]);
        }
    }

    /**
     * Deletes an existing Header model.
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

    public function actionDeleteBody()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            if ($id) {
                $body = Body::find()->where('id = :id', [':id' => $id])->one();
                $body->setScenario('delete-body');
                $body->status = 0;
                $body->user_id = Yii::$app->session->get('userId');
                if ($body->save()) {
                    return [
                        'status' => 'ok',
                        'msg' => 'Все ништяк!!!',
                    ];
                }
            }
            return [
                'status' => 'error',
                'msg' => 'Произошла ошибка!!!',
            ];
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

}