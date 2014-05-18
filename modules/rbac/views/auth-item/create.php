<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItem $model
 */
$this->title = Yii::t('rbac', 'Создание роли или разрешения');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Роли и разрешения'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">
    <?= $this->render('_form', [
        'model' => $model,
        'authRules' => $authRules,
        'types' => $types,
    ]) ?>
</div>