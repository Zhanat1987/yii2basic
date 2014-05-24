<?php

namespace app\modules\user\controllers;

use Yii;
use app\modules\user\models\LoginForm;
use app\modules\user\models\PasswordResetRequestForm;
use app\modules\user\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\components\MyController;

/**
 * Class AllowController
 * @package app\modules\user\controllers
 * гости
 */
class AllowController extends MyController
{

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

        return $this->render('login', [
            'model' => $model,
            'modelPRRF' => $modelPRRF,
        ]);
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

}