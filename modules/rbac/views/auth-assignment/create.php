<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthAssignment $model
 */
$this->title = Yii::t('user', 'Создание права доступа');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('rbac', 'Назначить права доступа'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">
    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'authItems' => $authItems,
    ]) ?>
</div>