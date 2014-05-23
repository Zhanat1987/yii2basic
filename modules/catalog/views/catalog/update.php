<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */

if ($type == 'common') {
    $this->title = Yii::t('catalog', 'Редактировать запись в общем справочнике: ') . $model->name;
    $this->params['breadcrumbs'][] = Yii::t('catalog', 'Общие справочники');
} else {
    $this->title = Yii::t('catalog', 'Редактировать запись в справочнике организаций: ') . $model->name;
    $this->params['breadcrumbs'][] = Yii::t('catalog', 'Справочники организаций');
}
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="catalog-update">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
    ]) ?>
</div>