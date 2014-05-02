<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthAssignment $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="auth-assignment-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'item_name')->dropDownList($authItems); ?>
    <?= $form->field($model, 'user_id')->dropDownList($users); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>