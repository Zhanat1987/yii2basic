<?php
/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 */
if ($model->id == Yii::$app->session->get('userId')) {
    $this->title = $this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование профиля');
} else {
    $this->title = Yii::t('user', 'Редактирование пользователя: ') . $model->id;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
}
?>
<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
        'statuses' => $statuses,
    ]) ?>
</div>