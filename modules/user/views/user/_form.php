<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'role')->dropDownList($roles); ?>
    <?= $form->field($model, 'status')->dropDownList($statuses); ?>
    <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'organization_id')->dropDownList($organizations); ?>
    <?= $form->field($model, 'department')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'post')->textInput(['maxlength' => 255]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>