<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthRule $model
 */
$this->title = Yii::t('rbac', 'Редактирование правила: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Правила'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="auth-rule-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>