<?php
/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthRule $model
 */
$this->title = Yii::t('rbac', 'Создание правила');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Правила'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-rule-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>