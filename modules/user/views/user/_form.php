<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
//use app\myhelpers\Debugger;
//Debugger::debug($model->getErrors());
//Debugger::debug($_POST);
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'rbac_role_name')->dropDownList($model->getRbacRoleNames()); ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => 64]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>