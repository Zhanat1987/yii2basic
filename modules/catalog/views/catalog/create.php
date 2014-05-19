<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */
if ($type == 'common') {
    $this->title = Yii::t('catalog', 'Создать запись в общем справочнике');
    $this->params['breadcrumbs'][] = [
        'label' => Yii::t('catalog', 'Общие справочники'),
        'url' => ['common']
    ];
} else {
    $this->title = Yii::t('catalog', 'Создать запись в справочнике организаций');
    $this->params['breadcrumbs'][] = [
        'label' => Yii::t('catalog', 'Справочники организаций'),
        'url' => ['organization']
    ];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-create">
    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'organizations' => $organizations,
    ]) ?>
</div>