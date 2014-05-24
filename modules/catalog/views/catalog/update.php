<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */
if ($catalogType[0] == 'common') {
    $this->params['breadcrumbs'][] = Yii::t('catalog', 'Общие справочники');
} else {
    $this->params['breadcrumbs'][] = Yii::t('catalog', 'Справочники по организациям');
}
$this->params['breadcrumbs'][] = $this->title = Yii::t('catalog', 'Редактировать ') .
    $catalogType[1] . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="catalog-update">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
    ]) ?>
</div>