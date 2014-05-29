<?php

namespace app\modules\user\models;

use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{

    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\modules\user\models\User',
                'filter' => ['status' => 1],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /** @var User $user */
        $user = User::findOne([
            'status' => 1,
            'email' => $this->email,
        ]);

        if ($user) {
            $user->generatePasswordResetToken();
            $user->setScenario('passwordReset');
            if ($user->save()) {
                return \Yii::$app->mail->compose('passwordResetToken', ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }

}