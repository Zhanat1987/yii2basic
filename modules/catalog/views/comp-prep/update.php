<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\CompPrep $model
 */
$this->title = Yii::t('comp_prep', 'Редактировать компонент/препарат: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Компоненты/препараты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('comp_prep', 'Update');
?>
<div class="comps-drugs-update">
    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
    ]) ?>
</div>