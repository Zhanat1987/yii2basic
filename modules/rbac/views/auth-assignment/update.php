<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthAssignment $model
 */
$this->title = Yii::t('rbac', 'Редактирование права доступа: ') . $model->item_name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('rbac', 'Назначить права доступа'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = [
    'label' => $model->item_name,
    'url' => ['view', 'item_name' => $model->item_name, 'organization_id' => $model->user_id]
];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="auth-assignment-update">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
        'authItems' => $authItems,
    ]) ?>
</div>