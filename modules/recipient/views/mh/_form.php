<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MH $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="mh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recipient_info_id')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'date_receipt')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'mkb10')->textInput() ?>

    <?= $form->field($model, 'date_discharge')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'treatment_outcome')->textInput() ?>

    <?= $form->field($model, 'personal')->textInput() ?>

    <?= $form->field($model, 'convey_place_residence')->textInput() ?>

    <?= $form->field($model, 'date_transmission_recipient')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'receiver')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'hiv_testing')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'hiv_number')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('recipient', 'Create') : Yii::t('recipient', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
