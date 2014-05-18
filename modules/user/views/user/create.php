<?php
/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 */
$this->title = Yii::t('user', 'Создание пользователя');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
        'roles' => $roles,
        'statuses' => $statuses,
    ]) ?>
</div>