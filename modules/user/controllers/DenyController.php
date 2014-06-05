<?php

namespace app\modules\user\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\modules\organization\models\Organization;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\Cookie;

/**
 * Class DenyController
 * @package app\modules\user\controllers
 * авторизованные пользователи
 */
class DenyController extends UserController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $this->redirect(Yii::$app->user->loginUrl);
    }

    public function actionProfile()
    {
        $model = $this->findModel(Yii::$app->getRequest()->getCookies()->getValue('userId'));
        return $this->render('@app/modules/user/views/user/view', [
            'model' => $model,
            'statuses' => $model->getStatuses(),
            'organizations' => Organization::getAllForLists(),
        ]);
    }

    public function actionProfileEdit()
    {
        $model = $this->findModel(Yii::$app->getRequest()->getCookies()->getValue('userId'));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile']);
        } else {
            return $this->render('@app/modules/user/views/user/update', [
                'model' => $model,
                'organizations' => Organization::getAllForLists(),
                'statuses' => $model->getStatuses(),
            ]);
        }
    }

    public function actionCompPrepColumns()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $module = Yii::$app->request->getQueryParam('module', '');
            $columns = Yii::$app->request->getQueryParam('columns', '');
            if ($module && $columns) {;
                $model = $this->findModel(Yii::$app->request->getCookies()->getValue('userId'));
                $userColumns = unserialize(Yii::$app->request->getCookies()->getValue('columns'));
                $userColumns['kkpk'][$module] = $columns;
                $model->columns = serialize($userColumns);
                $columns = new Cookie([
                    'name' => 'columns',
                    'value' => $model->columns,
                    'expire' => time() + 86400 * 30,
                ]);
                Yii::$app->getResponse()->getCookies()->add($columns);
                if ($model->save(false)) {
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