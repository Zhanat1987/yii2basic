<?php

namespace app\modules\user\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\modules\user\models\LoginForm;
use app\modules\user\models\PasswordResetRequestForm;
use app\modules\user\models\SignupForm;
use app\modules\user\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\modules\organization\models\Organization;
use app\modules\rbac\models\AuthItem;

class DefaultController extends UserController
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = '@app/layouts/login';
        $model = new LoginForm();
        if (isset($_POST['login-button'])) {
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }
        }

        $session = Yii::$app->session;
        $session->removeFlash('successPRRF');
        $session->removeFlash('errorPRRF');
        $modelPRRF = new PasswordResetRequestForm();
        if (isset($_POST['prrf-button'])) {
            if ($modelPRRF->load(Yii::$app->request->post()) && $modelPRRF->validate()) {
                if ($modelPRRF->sendEmail()) {
                    $session->setFlash('successPRRF',
                        Yii::t('common', 'Проверьте Ваш email для дальнейших инструкций.'));
                } else {
                    $session->setFlash('errorPRRF', Yii::t('common',
                        "Извините, мы не смогли сбросить пароль для указанного email'а."));
                }
            }
        }

        $modelSF = new SignupForm();
        if (isset($_POST['signup-button'])) {
            if ($modelSF->load(Yii::$app->request->post())) {
                $user = $modelSF->signup();
                if ($user) {
                    $model->setAttributes($modelSF->getAttributes());
                    if ($model->login($user)) {
                        return $this->goBack();
                    }
                }
            }
        }

        return $this->render('login', [
            'model' => $model,
            'modelPRRF' => $modelPRRF,
            'modelSF' => $modelSF,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $this->redirect(['login']);
    }

    public function actionResetPassword($token)
    {
        $this->layout = '@app/layouts/login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) &&
            $model->validate() && $model->resetPassword()) {
            $this->redirect(['login']);
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
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