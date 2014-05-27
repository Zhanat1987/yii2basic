<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\SelectBtn;
use app\widgets\CancelBtn;
use app\widgets\Personal;

/**
 * @var yii\web\View $this
 * @var app\modules\request\models\Header $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);

if ($errors) {
    echo \app\widgets\Errors::widget(['errors' => $errors]);
}
?>
<div class="header-form">
    <?php $form = ActiveForm::begin([
        'validateOnChange' => false,
        'validateOnSubmit' => false,
        'options' => [
            'id' => 'request-form',
        ]
    ]); ?>
    <?php
    echo $form->field($model, 'request_date')->textInput(
        [
            'maxlength' => 11,
            'class' => 'form-control tbDateTimePicker'
        ]
    );
    ?>
    <?= $form->field($model, 'urgency')->dropDownList($urgency, ['class' => 'select2 width100']); ?>
    <?= $form->field($model, 'type')->dropDownList($types, ['class' => 'select2 width100']); ?>
    <?php
    echo Personal::widget(
        [
            'model' => $model,
            'data' => $personal,
        ]
    );
    echo SelectBtn::widget(
        [
            'model' => $model,
            'attribute' => 'target',
            'data' => $targets,
            'options' => ['class' => 'select2 width100'],
            'modal' => 'catalog',
            'title' => $targetTitle,
            'titleCreate' => $targetTitleCreate,
            'editable' => 1,
        ]
    );
    ?>
    <?= $form->field($model, 'receiver')->dropDownList($organizations, ['class' => 'select2 width100']); ?>
    <?php
    echo $form->field($model, 'required_date')->textInput(
        [
            'maxlength' => 11,
            'class' => 'form-control tbDateTimePicker'
        ]
    );
    ?>
    <?php
    echo $form->field($model, 'execution_date')->textInput(
        [
            'maxlength' => 11,
            'class' => 'form-control tbDateTimePicker'
        ]
    );
    ?>
    <?= $form->field($model, 'status')->dropDownList($statuses, ['class' => 'select2 width100']); ?>
    <?php
    echo $this->render('bodies',
        [
            'modelsKK' => $modelsKK,
            'modelsPK' => $modelsPK,
            'form' => $form,
            'kks' => $kks,
            'pks' => $pks,
            'bloodGroups' => $bloodGroups,
            'rhFactors' => $rhFactors,
            'labels' => $labels,
        ]
    );
    ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo CancelBtn::widget(
            [
                'url' => '/request/request/index',
            ]
        );
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>