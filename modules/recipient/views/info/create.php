<?php
/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 */
$this->title = Yii::t('recipient', 'Создание реципиента');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Реципиенты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">
    <?= $this->render('_form', [
        'model' => $model,
        'genders' => $genders,
        'organizationIds' => $organizationIds,
        'bloodGroups' => $bloodGroups,
        'rhFactors' => $rhFactors,
        'answers' => $answers,
        'typesResidence' => $typesResidence,
        'citizenships' => $citizenships,
        'citizenshipTitle' => $citizenshipTitle,
        'citizenshipTitleCreate' => $citizenshipTitleCreate,
        'documentTypes' => $documentTypes,
        'documentTypesTitle' => $documentTypesTitle,
        'documentTypesTitleCreate' => $documentTypesTitleCreate,
        'documentIssueds' => $documentIssueds,
        'documentIssuedTitle' => $documentIssuedTitle,
        'documentIssuedTitleCreate' => $documentIssuedTitleCreate,
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
        'mh' => $mh,
        'personal' => $personal,
        'treatmentOutcomes' => $treatmentOutcomes,
        'treatmentOutcomeTitle' => $treatmentOutcomeTitle,
        'mhst' => $mhst,
        'mhstOrganizations' => $mhstOrganizations,
        'mha' => $mha,
        'mhaResults' => $mhaResults,
    ]) ?>
</div>