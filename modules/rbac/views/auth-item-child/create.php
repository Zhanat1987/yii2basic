<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItemChild $model
 */
$this->title = Yii::t('rbac', 'Создание иерархии');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Иерархия'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-create">
    <?= $this->render('_form', [
        'model' => $model,
        'authItems' => $authItems,
    ]) ?>
</div>