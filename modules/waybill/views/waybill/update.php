<?php
/**
 * @var yii\web\View $this
 * @var app\modules\waybill\models\Header $model
 */
$this->title = Yii::t('waybill', 'Накладная № ') . $model->id;
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('waybill', 'Накладные'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="header-update">
    <?= $this->render('_form', [
        'model' => $model,
        'statuses' => $statuses,
        'organizations' => $organizations,
    ]) ?>
</div>