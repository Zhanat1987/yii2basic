<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
$roleStatusClass = Yii::$app->session->get('role') == 'супер-администратор'
    ? 'select2 width100' : 'hide';
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'role')->dropDownList($roles,
        ['class' => $roleStatusClass]); ?>
    <?php if ($roleStatusClass == 'hide') : ?>
        <p>
            <?php echo $model->role; ?>
        </p>
    <?php endif; ?>
    <?= $form->field($model, 'status')->dropDownList($statuses,
        ['class' => $roleStatusClass]); ?>
    <?php if ($roleStatusClass == 'hide') : ?>
        <p>
            <?php echo $statuses[$model->status]; ?>
        </p>
    <?php endif; ?>
    <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'organization_id')->dropDownList($organizations,
        ['class' => 'select2 width100']); ?>
    <?= $form->field($model, 'department')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'post')->textInput(['maxlength' => 255]) ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
            Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>