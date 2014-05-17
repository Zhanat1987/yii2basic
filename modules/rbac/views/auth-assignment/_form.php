<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthAssignment $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="auth-assignment-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'item_name')->dropDownList($authItems, ['class' => 'select2 width-400']); ?>
    <?= $form->field($model, 'user_id')->dropDownList($users, ['class' => 'select2 width-150']); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>