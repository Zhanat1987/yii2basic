<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="auth-item-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'type')->dropDownList($model->getTypes()); ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?php //echo $form->field($model, 'data')->textarea(['rows' => 6]); ?>
    <?= $form->field($model, 'rule_name')->dropDownList($authRules); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>