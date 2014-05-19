<?php

namespace app\modules\user\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\modules\organization\models\Organization;
use app\modules\rbac\models\AuthItem;

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
        $model = $this->findModel(Yii::$app->session->get('userId'));
        return $this->render('@app/modules/user/views/user/view', [
            'model' => $model,
            'statuses' => $model->getStatuses(),
        ]);
    }

    public function actionProfileEdit()
    {
        $model = $this->findModel(Yii::$app->session->get('userId'));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile']);
        } else {
            return $this->render('@app/modules/user/views/user/update', [
                'model' => $model,
                'organizations' => (new Organization)->getAllForLists(),
                'roles' => AuthItem::getRoles(),
                'statuses' => $model->getStatuses(),
            ]);
        }
    }

}