<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\CompPrep $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="comps-drugs-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'type')->dropDownList($types,
        ['class' => 'select2 width100']); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>
    <?= $form->field($model, 'short_name')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'group')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'infodonor_id')->textInput() ?>
    <?= $form->field($model, 'alert_time')->textInput(['maxlength' => 50]) ?>
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