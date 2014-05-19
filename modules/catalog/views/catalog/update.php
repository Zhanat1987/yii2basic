<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */

if ($type == 'common') {
    $this->title = Yii::t('catalog', 'Редактировать запись в общем справочнике: ') . $model->name;
    $this->params['breadcrumbs'][] = [
        'label' => Yii::t('catalog', 'Общие справочники'),
        'url' => ['common']
    ];
} else {
    $this->title = Yii::t('catalog', 'Редактировать запись в справочнике организаций: ') . $model->name;
    $this->params['breadcrumbs'][] = [
        'label' => Yii::t('catalog', 'Справочники организаций'),
        'url' => ['organization']
    ];
}
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="catalog-update">
    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'organizations' => $organizations,
    ]) ?>
</div>