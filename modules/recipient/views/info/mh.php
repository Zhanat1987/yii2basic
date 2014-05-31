<?= $form->field($model, 'number')->textInput() ?>
<?= $form->field($model, 'date_receipt')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?= $form->field($model, 'mkb10')->textInput() ?>
<?= $form->field($model, 'hiv_testing')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'hiv_number')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'date_discharge')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?= $form->field($model, 'treatment_outcome')->textInput() ?>
<?= $form->field($model, 'personal')->textInput() ?>
<?php
echo $form->field($model, 'convey_place_residence')->dropDownList(
    $answers,
    [
        'class' => 'select2 width100'
    ]
);
?>
