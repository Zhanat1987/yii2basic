<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */
if ($type == 'common') {
    $this->title = Yii::t('catalog', 'Создать запись в общем справочнике');
    $this->params['breadcrumbs'][] = Yii::t('catalog', 'Общие справочники');
} else {
    $this->title = Yii::t('catalog', 'Создать запись в справочнике организаций');
    $this->params['breadcrumbs'][] = Yii::t('catalog', 'Справочники организаций');
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-create">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
    ]) ?>
</div>