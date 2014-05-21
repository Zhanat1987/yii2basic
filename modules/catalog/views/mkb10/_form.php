<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\CancelBtn;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Mkb10 $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="mkb10-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'f1')->textInput(['maxlength' => 3]) ?>
    <?= $form->field($model, 'f2')->textInput(['maxlength' => 3]) ?>
    <?= $form->field($model, 'f3')->textInput(['maxlength' => 2]) ?>
    <?= $form->field($model, 'diagnosis')->textInput(['maxlength' => 254]) ?>
    <?= $form->field($model, 'status')->dropDownList(Yii::$app->current->getStatuses(),
        ['class' => 'select2 width100']); ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo CancelBtn::widget(
            [
                'url' => '/catalog/mkb10/index',
            ]
        );
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>