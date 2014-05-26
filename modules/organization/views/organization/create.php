<?php
/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 */
$this->title = Yii::t('organization', 'Создание организации');;
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
        'regionTitle' => $regionTitle,
        'regionAreaTitle' => $regionAreaTitle,
        'cityTitle' => $cityTitle,
        'streetTitle' => $streetTitle,
        'regionTitleCreate' => $regionTitleCreate,
        'regionAreaTitleCreate' => $regionAreaTitleCreate,
        'cityTitleCreate' => $cityTitleCreate,
        'streetTitleCreate' => $streetTitleCreate,
        'roles' => $roles,
    ]) ?>
</div>