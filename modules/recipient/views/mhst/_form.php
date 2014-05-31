<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MHST $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="mhst-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recipient_medical_history_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'date_send')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'date_receive')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'receiver')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('recipient', 'Create') : Yii::t('recipient', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
