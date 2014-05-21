<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\SelectBtn;

/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="organization-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'short_name')->textInput(['maxlength' => 255]) ?>
    <?php
    echo SelectBtn::widget(
        [
            'model' => $model,
            'attribute' => 'region_id',
            'data' => $regions,
            'options' => ['class' => 'select2 width100']
        ]
    );
    echo SelectBtn::widget(
        [
            'model' => $model,
            'attribute' => 'region_area_id',
            'data' => $regionAreas,
            'options' => ['class' => 'select2 width100']
        ]
    );
    echo SelectBtn::widget(
        [
            'model' => $model,
            'attribute' => 'city_id',
            'data' => $cities,
            'options' => ['class' => 'select2 width100']
        ]
    );
    echo SelectBtn::widget(
        [
            'model' => $model,
            'attribute' => 'street_id',
            'data' => $streets,
            'options' => ['class' => 'select2 width100']
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
    <?= $form->field($model, 'status')->dropDownList(Yii::$app->current->getStatuses(),
        ['class' => 'select2 width100']); ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>