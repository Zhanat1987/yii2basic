<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItem $model
 */
$this->title = Yii::t('rbac', 'Редактирование роли или разрешения: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Роли и разрешения'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="auth-item-update">
    <?= $this->render('_form', [
        'model' => $model,
        'authRules' => $authRules,
        'types' => $types,
    ]) ?>
</div>