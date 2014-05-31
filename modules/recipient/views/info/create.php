<?php
/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 */
$this->title = Yii::t('recipient', 'Создание реципиента');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Реципиенты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>