<?php
use app\widgets\SelectBtn;
?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'surname')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'patronymic')->textInput(['maxlength' => 50]) ?>
<?php
echo $form->field($model, 'sex')->dropDownList(
    $genders,
    [
        'class' => 'select2 width100'
    ]
);
?>
<?php
echo $form->field($model, 'birthday')->textInput(
    [
        'maxlength' => 11,
        'class' => 'form-control tbDatePicker',
    ]
);
?>
<?php
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'citizenship',
        'data' => $citizenships,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $citizenshipTitle,
        'titleCreate' => $citizenshipTitleCreate,
        'editable' => 1,
    ]
);
?>
<?= $form->field($model, 'iin')->textInput() ?>
<?php
echo $form->field($model, 'organization_id')->dropDownList(
    $organizationIds,
    [
        'class' => 'select2 width100'
    ]
);
?>
<?php
echo $form->field($model, 'blood_group')->dropDownList(
    $bloodGroups,
    [
        'class' => 'select2 width100'
    ]
);
?>
<?php
echo $form->field($model, 'rh_factor')->dropDownList(
    $rhFactors,
    [
        'class' => 'select2 width100'
    ]
);
?>
<br /><hr /><br />
<?php
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'document_types',
        'data' => $documentTypes,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $documentTypesTitle,
        'titleCreate' => $documentTypesTitleCreate,
        'editable' => 1,
    ]
);
?>
<?= $form->field($model, 'document_series')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'document_number')->textInput(['maxlength' => 50]) ?>
<?php
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'document_issued',
        'data' => $documentIssueds,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $documentIssuedTitle,
        'titleCreate' => $documentIssuedTitleCreate,
        'editable' => 1,
    ]
);
?>
<?php
echo $form->field($model, 'document_date_issue')->textInput(
    [
        'maxlength' => 11,
        'class' => 'form-control  tbDatePicker',
    ]
);
?>
<?php
echo $form->field($model, 'document_date_expiration')->textInput(
    [
        'maxlength' => 11,
        'class' => 'form-control  tbDatePicker',
    ]
);
?>
<br /><hr /><br />
<?php
echo $form->field($model, 'homeless')->dropDownList(
    $answers,
    [
        'class' => 'select2 width100'
    ]
);
?>
<?php
echo $form->field($model, 'type_residence')->dropDownList(
    $typesResidence,
    [
        'class' => 'select2 width100'
    ]
);
?>
<br /><hr /><br />
<?php
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_reg_addr_region_id',
        'data' => $regions,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $regionTitle,
        'titleCreate' => $regionTitleCreate,
        'editable' => 0,
    ]
);
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_reg_addr_region_area_id',
        'data' => $regionAreas,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $regionAreaTitle,
        'titleCreate' => $regionAreaTitleCreate,
        'editable' => 0,
    ]
);
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_reg_addr_city_id',
        'data' => $cities,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $cityTitle,
        'titleCreate' => $cityTitleCreate,
        'editable' => 1,
    ]
);
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_reg_street_id',
        'data' => $streets,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $streetTitle,
        'titleCreate' => $streetTitleCreate,
        'editable' => 1,
    ]
);
?>
<?= $form->field($model, 'addr_reg_home')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'addr_reg_flat')->textInput(['maxlength' => 50]) ?>
<br /><hr /><br />
<?php
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_res_addr_region_id',
        'data' => $regions,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $regionTitle,
        'titleCreate' => $regionTitleCreate,
        'editable' => 0,
    ]
);
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_res_addr_region_area_id',
        'data' => $regionAreas,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $regionAreaTitle,
        'titleCreate' => $regionAreaTitleCreate,
        'editable' => 0,
    ]
);
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_res_addr_city_id',
        'data' => $cities,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $cityTitle,
        'titleCreate' => $cityTitleCreate,
        'editable' => 1,
    ]
);
echo SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'addr_res_street_id',
        'data' => $streets,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $streetTitle,
        'titleCreate' => $streetTitleCreate,
        'editable' => 1,
    ]
);
?>
<?= $form->field($model, 'addr_res_home')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'addr_res_flat')->textInput(['maxlength' => 50]) ?>
<br /><hr /><br />
<?= $form->field($model, 'work_department')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'work_post')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'work_phone')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'work_name')->textInput(['maxlength' => 100]) ?>