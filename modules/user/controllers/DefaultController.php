<?php

namespace app\modules\user\controllers;

use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use app\components\MyController;
use app\myhelpers\Debugger;
use yii\filters\VerbFilter;
use app\modules\user\models\LoginForm;
use app\modules\user\models\PasswordResetRequestForm;
use app\modules\user\models\SignupForm;
use app\modules\user\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class DefaultController extends MyController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
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

        $modelPRRF = new PasswordResetRequestForm();
        if (isset($_POST['prrf-button'])) {
            if ($modelPRRF->load(Yii::$app->request->post()) && $modelPRRF->validate()) {
                if ($modelPRRF->sendEmail()) {
                    Yii::$app->getSession()->setFlash('successPRRF',
                        'Проверьте Ваш email для дальнейших инструкций.');
                } else {
                    Yii::$app->getSession()->setFlash('errorPRRF',
                        "Извините, мы не смогли сбросить пароль для указанного email'а.");
                }
            }
        }

        $modelSF = new SignupForm();
        if (isset($_POST['signup-button'])) {
            if ($modelSF->load(Yii::$app->request->post())) {
                $user = $modelSF->signup();
                if ($user) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
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

        return $this->goHome();
    }

    public function actionResetPassword($token)
    {
        $this->layout = '@app/layouts/login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            $this->redirect(['login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
