<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $user
 */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/reset-password',
    'token' => $user->password_reset_token]);
$html = Yii::t('common', 'Здрваствуйте') . ', ' . Html::encode($user->username) .
    '!<br />' . Yii::t('common', 'Пройдите по следующей ссылке, чтобы восстановить пароль') .
    ':<br />' . Html::a(Html::encode($resetLink), $resetLink);
echo $html;
?>