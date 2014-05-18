<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItemChild $model
 */
$this->title = Yii::t('rbac', 'Редактирование иерархии: ') . $model->parent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Иерархия'), 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->parent,
    'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]
];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="auth-item-child-update">
    <?= $this->render('_form', [
        'model' => $model,
        'authItems' => $authItems,
    ]) ?>
</div>