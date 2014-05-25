<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\request\models\Header $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="header-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_date')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'urgency')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'personal')->textInput() ?>

    <?= $form->field($model, 'target')->textInput() ?>

    <?= $form->field($model, 'receiver')->textInput() ?>

    <?= $form->field($model, 'request_status')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'execution_date')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'required_date')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'was_read')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('request', 'Create') : Yii::t('request', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
