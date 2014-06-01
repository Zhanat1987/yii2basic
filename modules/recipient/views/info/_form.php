<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\CancelBtn;
use app\widgets\SelectBtn;
//use app\assets\RecipientAsset;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);

//RecipientAsset::register($this);
//
//if (Yii::$app->controller->action->id == 'view') {
//    $this->registerJs("disabledForm('recipient-form', '/recipient/info/index');");
//} else if ($errors) {
//    echo \app\widgets\Errors::widget(['errors' => $errors]);
//}
?>
<div class="info-form">
    <?php $form = ActiveForm::begin([
        'validateOnChange' => false,
        'validateOnSubmit' => false,
        'options' => [
            'id' => 'recipient-form',
        ]
    ]); ?>
    <div class="col-md-12">
        <div class="box border">
            <div class="box-title">
                <h4>
                    <?php echo Yii::t('recipient', 'Анкета реципиента'); ?>
                </h4>
            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">
                        <li>
                            <a data-toggle="tab" href="#box_tab3">
                                <i class="fa fa-desktop"></i>
                            <span class="hidden-inline-mobile">
                                <?php echo Yii::t('recipient', 'Анализы'); ?>
                            </span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#box_tab2">
                                <i class="fa fa-flask"></i>
                            <span class="hidden-inline-mobile">
                                <?php echo Yii::t('recipient', 'История болезни'); ?>
                            </span>
                            </a>
                        </li>
                        <li class="active">
                            <a data-toggle="tab" href="#box_tab1">
                                <i class="fa fa-home"></i>
                            <span class="hidden-inline-mobile">
                                <?php echo Yii::t('recipient', 'Личная информация'); ?>
                            </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="box_tab1" class="tab-pane fade active in">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
                            <?= $form->field($model, 'surname')->textInput(['maxlength' => 50]) ?>
                            <?= $form->field($model, 'patronymic')->textInput(['maxlength' => 50]) ?>
                            <?= $form->field($model, 'sex')->dropDownList($genders, ['class' => 'select2 width100']); ?>
                            <?php
                            echo $form->field($model, 'birthday')->textInput(
                                [
                                    'maxlength' => 11,
                                    'class' => 'form-control  tbDatePicker',
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
                        </div>
                        <div id="box_tab2" class="tab-pane fade">
                            <?php
                            echo $this->render('mh', [
                                'form' => $form,
                                'model' => $mh,
                                'mkb10' => $mkb10,
                                'answers' => $answers,
                                'personal' => $personal,
                                'treatmentOutcomes' => $treatmentOutcomes,
                                'treatmentOutcomeTitle' => $treatmentOutcomeTitle,
                            ]);
                            ?>
                            <?php
                            echo $this->render('mhst', [
                                'form' => $form,
                                'model' => $mhst,
                                'organizations' => $mhstOrganizations,
                            ]);
                            ?>
                        </div>
                        <div id="box_tab3" class="tab-pane fade">
                            <?php
                            echo $this->render('mha', [
                                'form' => $form,
                                'model' => $mha,
                                'results' => $mhaResults,
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        if (Yii::$app->controller->action->id != 'view') {
            echo CancelBtn::widget(
                [
                    'url' => '/recipient/info/index',
                ]
            );
        }
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>