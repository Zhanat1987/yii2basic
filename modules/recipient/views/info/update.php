<?php
/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 */
$this->title = Yii::t('recipient', 'Реципиент ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Реципиенты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="info-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>