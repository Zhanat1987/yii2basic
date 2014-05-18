<?php
/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 */
$this->title = Yii::t('user', 'Редактирование пользователя: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
        'roles' => $roles,
        'statuses' => $statuses,
    ]) ?>
</div>