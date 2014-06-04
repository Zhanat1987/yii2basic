<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\CancelBtn;
use app\assets\RecipientAsset;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
RecipientAsset::register($this);

if ($errors) {
    echo \app\widgets\Errors::widget(['errors' => $errors]);
}
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
                            <?php
                            echo $this->render('info', [
                                'form' => $form,
                                'model' => $model,
                                'genders' => $genders,
                                'citizenships' => $citizenships,
                                'citizenshipTitle' => $citizenshipTitle,
                                'citizenshipTitleCreate' => $citizenshipTitleCreate,
                                'organizationIds' => $organizationIds,
                                'bloodGroups' => $bloodGroups,
                                'rhFactors' => $rhFactors,
                                'documentTypes' => $documentTypes,
                                'documentTypesTitle' => $documentTypesTitle,
                                'documentTypesTitleCreate' => $documentTypesTitleCreate,
                                'documentIssueds' => $documentIssueds,
                                'documentIssuedTitle' => $documentIssuedTitle,
                                'documentIssuedTitleCreate' => $documentIssuedTitleCreate,
                                'answers' => $answers,
                                'typesResidence' => $typesResidence,
                                'regions' => $regions,
                                'regionTitle' => $regionTitle,
                                'regionTitleCreate' => $regionTitleCreate,
                                'regionAreas' => $regionAreas,
                                'regionAreaTitle' => $regionAreaTitle,
                                'regionAreaTitleCreate' => $regionAreaTitleCreate,
                                'cities' => $cities,
                                'cityTitle' => $cityTitle,
                                'cityTitleCreate' => $cityTitleCreate,
                                'streets' => $streets,
                                'streetTitle' => $streetTitle,
                                'streetTitleCreate' => $streetTitleCreate,
                            ]);
                            ?>
                        </div>
                        <div id="box_tab2" class="tab-pane fade">
                            <?php
                            echo $this->render('mh', [
                                'form' => $form,
                                'model' => $mh,
                                'mkb10' => $mkb10,
                                'answers' => Yii::$app->current->defaultValue($answers, false),
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
                            <?php
                            echo $this->render('epicrisis', [
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