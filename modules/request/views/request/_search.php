<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\request\models\search\HeaderSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="header-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'request_date') ?>

    <?= $form->field($model, 'urgency') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'personal') ?>

    <?php // echo $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'receiver') ?>

    <?php // echo $form->field($model, 'execution_date') ?>

    <?php // echo $form->field($model, 'required_date') ?>

    <?php // echo $form->field($model, 'request_status') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'organization_id') ?>

    <?php // echo $form->field($model, 'was_read') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('request', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('request', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
