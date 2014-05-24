<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthAssignment $model
 */
$this->title = Yii::t('rbac', 'Создание права доступа');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('rbac', 'Назначить права доступа'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
        'authItems' => $authItems,
    ]) ?>
</div>