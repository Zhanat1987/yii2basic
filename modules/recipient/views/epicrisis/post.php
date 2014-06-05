<?php
echo \app\widgets\Personal::widget(
    [
        'model' => $model,
        'data' => $personal,
    ]
);
?>
<?php
echo $form->field($model, 'method_transfusion')->dropDownList(
    $methodsTransfusion,
    [
        'class' => 'select2 width100'
    ]
);
?>
<?php
echo $form->field($model, 'reaction')->dropDownList(
    $reactions,
    [
        'class' => 'select2 width100'
    ]
);
?>
<?= $form->field($model, 'number_transfusion')->textInput(['maxlength' => 50]) ?>
<?php
echo $form->field($model, 'date_transfusion')->textInput(
    [
        'maxlength' => 11,
        'class' => 'form-control tbDateTimePicker'
    ]);
?>
<?= $form->field($model, 'arterial_pressure')->textInput(['maxlength' => 50]) ?>
<?php
echo $form->field($model, 'type_transfusion')->dropDownList(
    $typesTransfusion,
    [
        'class' => 'select2 width100'
    ]
);
?>
<?= $form->field($model, 'pulse')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'temperature')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'has_been_reaction')->textInput(['maxlength' => 50]) ?>
<br /><hr /><br />
<?= $form->field($model, 'compatibility_room_temperature')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'compatibility_thermal_samples')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'compatibility_biological_sample')->textInput(['maxlength' => 50]) ?>
<br /><hr /><br />
<?php
echo $form->field($model, 'transfusion_completion_date')->textInput(
    [
        'maxlength' => 11,
        'class' => 'form-control tbDateTimePicker'
    ]);
?>
<?= $form->field($model, 'transfusion_completion_pulse')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'transfusion_completion_arterial_pressure')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'transfusion_completion_temperature_one_hour')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'transfusion_completion_temperature_two_hour')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'transfusion_completion_temperature_three_hour')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'transfusion_completion_color_first_urine')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'transfusion_completion_daily_urine')->textInput(['maxlength' => 50]) ?>
<?php
echo \app\widgets\Personal::widget(
    [
        'model' => $model,
        'data' => $personal,
        'attribute' => 'transfusion_completion_id_spr_personal',
    ]
);
?>