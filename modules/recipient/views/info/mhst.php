<?= $form->field($model, 'date_send')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?php
echo $form->field($model, 'receiver')->dropDownList(
    $organizations,
    [
        'class' => 'select2 width100'
    ]
);
?>