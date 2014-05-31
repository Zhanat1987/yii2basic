<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MHA $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="mha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recipient_medical_history_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'hiv_1_result')->textInput() ?>

    <?= $form->field($model, 'hiv_1_date')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'hiv_1_organization_id')->textInput() ?>

    <?= $form->field($model, 'hiv_1_user_id')->textInput() ?>

    <?= $form->field($model, 'hiv_2_result')->textInput() ?>

    <?= $form->field($model, 'hiv_2_date')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'hiv_2_organization_id')->textInput() ?>

    <?= $form->field($model, 'hiv_2_user_id')->textInput() ?>

    <?= $form->field($model, 'hiv_3_result')->textInput() ?>

    <?= $form->field($model, 'hiv_3_date')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'hiv_3_organization_id')->textInput() ?>

    <?= $form->field($model, 'hiv_3_user_id')->textInput() ?>

    <?= $form->field($model, 'hiv_1_number')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'hiv_2_number')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'hiv_3_number')->textInput(['maxlength' => 250]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('recipient', 'Create') : Yii::t('recipient', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
