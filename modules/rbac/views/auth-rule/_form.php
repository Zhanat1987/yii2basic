<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\CancelBtn;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthRule $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="auth-rule-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo CancelBtn::widget(
            [
                'url' => '/rbac/auth-rule/index',
            ]
        );
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>