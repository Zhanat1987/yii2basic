<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItemChild $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="auth-item-child-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'parent')->dropDownList($authItems, ['class' => 'select2 width-400']); ?>
    <?= $form->field($model, 'child')->dropDownList($authItems, ['class' => 'select2 width-400']); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>