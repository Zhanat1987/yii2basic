<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\search\Mkb10Search $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="mkb10-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'f1') ?>

    <?= $form->field($model, 'f2') ?>

    <?= $form->field($model, 'f3') ?>

    <?= $form->field($model, 'icd10') ?>

    <?php // echo $form->field($model, 'diagnosis') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('mkb10', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('mkb10', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
