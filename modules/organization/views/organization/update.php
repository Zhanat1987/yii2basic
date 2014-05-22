<?php
/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 */
$this->title = Yii::t('organization', 'Организация: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('organization', 'Организации'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="organization-update">
    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'regionAreas' => $regionAreas,
        'cities' => $cities,
        'streets' => $streets,
        'regionTitle' => $regionTitle,
        'regionAreaTitle' => $regionAreaTitle,
        'cityTitle' => $cityTitle,
        'streetTitle' => $streetTitle,
        'regionTitleCreate' => $regionTitleCreate,
        'regionAreaTitleCreate' => $regionAreaTitleCreate,
        'cityTitleCreate' => $cityTitleCreate,
        'streetTitleCreate' => $streetTitleCreate,
    ]) ?>
</div>