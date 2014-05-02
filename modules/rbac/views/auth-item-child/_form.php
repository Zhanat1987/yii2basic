<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItemChild $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="auth-item-child-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'parent')->dropDownList($authItems); ?>
    <?= $form->field($model, 'child')->dropDownList($authItems); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>