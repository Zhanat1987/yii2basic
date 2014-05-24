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
$this->params['breadcrumbs'][] = $this->title = Yii::t('catalog', 'Создать ') . $catalogType[1];
?>
<div class="catalog-create">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
    ]) ?>
</div>