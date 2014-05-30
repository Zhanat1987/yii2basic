<?php

namespace app\modules\request\controllers;

use Yii;
use app\modules\request\models\Header;
use app\modules\request\models\search\HeaderSearch;
use app\Components\MyController;
use yii\web\NotFoundHttpException;
use app\modules\organization\models\Organization;
use app\modules\catalog\models\Personal;
use app\actions\DeleteAction;
use app\modules\catalog\models\Catalog;
use app\modules\request\models\Body;
use yii\db\Exception;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use app\modules\catalog\models\CompPrep;

/**
 * RequestController implements the CRUD actions for Header model.
 */
class RequestController extends MyController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Header::className(),
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
            'wasRead' => Yii::$app->current->defaultValue($searchModel->getWasRead()),
        ]);
    }

    /**
     * Displays a single Header model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelKK = new Body;
        $modelKK->type = 1;
        $modelsKK[] = $modelKK;
        $modelPK = clone $modelKK;
        $modelPK->type = 2;
        $modelsPK[] = $modelPK;
        $errors = [];
        $modelsBodies = Body::find()->where('request_header_id =:request_header_id AND status = 1',
            [':request_header_id' => $id])->all();
        if ($modelsBodies) {
            foreach ($modelsBodies as $modelBodies) {
                if ($modelBodies->type == 1) {
                    $modelsKK[] = $modelBodies;
                } else if ($modelBodies->type == 2) {
                    $modelsPK[] = $modelBodies;
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'urgency' => $model->getUrgency(),
            'types' => $model->getTypes(),
            'organizations' => Organization::getAllForListsByRole('Центр крови'),
            'targets' => Catalog::getAllForLists(13, Yii::$app->session->get('organizationId')),
            'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
            'targetTitle' => Catalog::getData('target', 1),
            'targetTitleCreate' => Catalog::getData('target', 2),
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
            foreach ($body['type'] as $k => $v) {
                if ($modelKK->isEmpty($body, $v, $k)) {
                    continue;
                }
                $modelBody = new Body;
                $modelBody->comp_prep_id = $body['comp_prep_id'][$k];
                $modelBody->volume = $body['volume'][$k];
                $modelBody->quantity = $body['quantity'][$k];
                if ($v == 1) {
                    $modelBody->scenario ='kk';
                    $modelBody->type = 1;
                    $modelBody->blood_group = $body['blood_group'][$k];
                    $modelBody->rh_factor = $body['rh_factor'][$k];
                    $modelBody->phenotype = $body['phenotype'][$k];
                } else if ($v == 2) {
                    $modelBody->scenario ='pk';
                    $modelBody->type = 2;
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
                        $modelB->request_header_id = $model->id;
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
            'urgency' => $model->getUrgency(),
            'types' => $model->getTypes(),
            'organizations' => Organization::getAllForListsByRole('Центр крови'),
            'organizationIds' => Yii::$app->session->get('role') == 'супер-администратор' ||
                Yii::$app->session->get('role') == 'администратор' ?
                    Organization::getAllForListsByRole('Стационар') : null,
            'targets' => Catalog::getAllForLists(13, Yii::$app->session->get('organizationId')),
            'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
            'targetTitle' => Catalog::getData('target', 1),
            'targetTitleCreate' => Catalog::getData('target', 2),
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

    /**
     * Updates an existing Header model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
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
            foreach ($body['type'] as $k => $v) {
                if ($modelKK->isEmpty($body, $v, $k)) {
                    continue;
                }
                $modelBody = new Body;
                $modelBody->comp_prep_id = $body['comp_prep_id'][$k];
                $modelBody->volume = $body['volume'][$k];
                $modelBody->quantity = $body['quantity'][$k];
                if ($v == 1) {
                    $modelBody->scenario ='kk';
                    $modelBody->type = 1;
                    $modelBody->blood_group = $body['blood_group'][$k];
                    $modelBody->rh_factor = $body['rh_factor'][$k];
                    $modelBody->phenotype = $body['phenotype'][$k];
                } else if ($v == 2) {
                    $modelBody->scenario ='pk';
                    $modelBody->type = 2;
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
                if ($model->receiver = Yii::$app->session->get('organizationId')) {
                    $model->was_read = 1;
                }
                $model->save(false);
                Body::deleteAll('request_header_id = :request_header_id', [':request_header_id' => $model->id]);
                foreach ($modelsB as $modelB) {
                    try {
                        $modelB->request_header_id = $model->id;
                        $modelB->save(false);
                    } catch (Exception $e) {
                        Yii::$app->debugger->exception($e);
                    }
                }
                $this->redirect(['index']);
            }
        } else {
            $modelsBodies = Body::find()->where('request_header_id =:request_header_id AND status = 1',
                [':request_header_id' => $id])->all();
            if ($modelsBodies) {
                foreach ($modelsBodies as $modelBodies) {
                    if ($modelBodies->type == 1) {
                        $modelsKK[] = $modelBodies;
                    } else if ($modelBodies->type == 2) {
                        $modelsPK[] = $modelBodies;
                    }
                }
            }
        }
        $modelsKK[] = clone $modelKK;
        $modelsPK[] = clone $modelPK;
        return $this->render('update', [
            'model' => $model,
            'urgency' => $model->getUrgency(),
            'types' => $model->getTypes(),
            'organizations' => Organization::getAllForListsByRole('Центр крови'),
            'organizationIds' => Yii::$app->session->get('role') == 'супер-администратор' ||
                Yii::$app->session->get('role') == 'администратор' ?
                Organization::getAllForListsByRole('Стационар') : null,
            'targets' => Catalog::getAllForLists(13, Yii::$app->session->get('organizationId')),
            'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists(), false),
            'targetTitle' => Catalog::getData('target', 1),
            'targetTitleCreate' => Catalog::getData('target', 2),
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

    public function actionModal()
    {
        if (Yii::$app->request->isAjax) {
            $searchModel = new HeaderSearch;
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

            return $this->renderAjax('modal', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'statuses' => Yii::$app->current->defaultValue($searchModel->getStatuses()),
                'organizations' => Yii::$app->current->defaultValue(
                        Organization::getAllForListsByRole('Центр крови')),
                'personal' => Yii::$app->current->defaultValue(Personal::getAllForLists()),
                'wasRead' => Yii::$app->current->defaultValue($searchModel->getWasRead()),
            ]);
        } else {
            throw new BadRequestHttpException(Yii::t('common', "Запрос не ajax'овский!!!"));
        }
    }

    public function actionInfo()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            if ($id && (($data = Body::getInfo($id)) !== false)) {
                return [
                    'status' => 'ok',
                    'msg' => 'Все ништяк!!!',
                    'kk' => isset($data['kk']) ? $data['kk'] : [],
                    'pk' => isset($data['pk']) ? $data['pk'] : [],
                ];
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