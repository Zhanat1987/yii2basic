<?php
/**
 * @var yii\web\View $this
 * @var app\modules\waybill\models\Header $model
 */
$this->title = Yii::t('request', 'Создание накладной');;
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('waybill', 'Накладные'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-create">
    <?= $this->render('_form', [
        'model' => $model,
        'statuses' => $statuses,
        'organizations' => $organizations,
    ]) ?>
</div>