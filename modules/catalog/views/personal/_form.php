<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Personal $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="personal-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'patronimic')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'post')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'department')->dropDownList($departments,
        ['class' => 'select2 width100']); ?>
    <?= $form->field($model, 'organization_id')->dropDownList($organizations,
        ['class' => 'select2 width100']); ?>
    <?= $form->field($model, 'status')->dropDownList(Yii::$app->current->getStatuses(),
        ['class' => 'select2 width100']); ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>