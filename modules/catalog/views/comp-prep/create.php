<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\CompPrep $model
 */
$this->title = Yii::t('comp_prep', 'Создать компонент/препарат');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Компоненты/препараты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comps-drugs-create">
    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
    ]) ?>
</div>