<?php
/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 */
$this->title = Yii::t('user', 'Создание организации');;
$this->params['breadcrumbs'][] = ['label' => Yii::t('organization', 'Организации'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-create">
    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'regionAreas' => $regionAreas,
        'cities' => $cities,
        'streets' => $streets,
    ]) ?>
</div>