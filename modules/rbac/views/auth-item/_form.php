<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\CancelBtn;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="auth-item-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'type')->dropDownList($types, ['class' => 'select2 width100']); ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?php echo $form->field($model, 'data')->textarea(['rows' => 6]); ?>
    <?= $form->field($model, 'rule_name')->dropDownList($authRules, ['class' => 'select2 width100']); ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo CancelBtn::widget(
            [
                'url' => '/rbac/auth-item/index',
            ]
        );
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>