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
    <?= $form->field($model, 'parent')->dropDownList($authItems, ['class' => 'select2 width100']); ?>
    <?= $form->field($model, 'child')->dropDownList($authItems, ['class' => 'select2 width100']); ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>