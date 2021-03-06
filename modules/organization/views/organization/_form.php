<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\SelectBtn;
use app\widgets\CancelBtn;

/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="organization-form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'organization-form',
        ]
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'short_name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'role')->dropDownList($roles, ['class' => 'select2 width100']); ?>
    <?php
    echo SelectBtn::widget(
        [
            'model' => $model,
            'attribute' => 'region_id',
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
            'attribute' => 'region_area_id',
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
            'attribute' => 'city_id',
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
            'attribute' => 'street_id',
            'data' => $streets,
            'options' => ['class' => 'select2 width100'],
            'modal' => 'catalog',
            'title' => $streetTitle,
            'titleCreate' => $streetTitleCreate,
            'editable' => 1,
        ]
    );
    ?>
    <?= $form->field($model, 'home_number')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'bin')->textInput() ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'chief_phone')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'chief_email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'infodonor_id')->textInput() ?>
    <?= $form->field($model, 'curl')->textInput(['maxlength' => 255]) ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo CancelBtn::widget(
            [
                'url' => '/organization/organization/index',
            ]
        );
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>