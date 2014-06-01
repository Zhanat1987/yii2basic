<?= $form->field($model, 'number')->textInput() ?>
<?= $form->field($model, 'date_receipt')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?= $form->field($model, 'mkb10')->textInput() ?>
<?php
echo \app\widgets\Mkb10::widget(
    [
        'model' => $model,
        'data' => $mkb10,
    ]
);
?>
<?= $form->field($model, 'hiv_testing')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'hiv_number')->textInput(['maxlength' => 50]) ?>
<?= $form->field($model, 'date_discharge')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?php
echo \app\widgets\SelectBtn::widget(
    [
        'model' => $model,
        'attribute' => 'treatment_outcome',
        'data' => $treatmentOutcomes,
        'options' => ['class' => 'select2 width100'],
        'modal' => 'catalog',
        'title' => $treatmentOutcomeTitle,
        'editable' => 0,
    ]
);
?>
<?php
echo \app\widgets\Personal::widget(
    [
        'model' => $model,
        'data' => $personal,
    ]
);
?>
<?php
echo $form->field($model, 'convey_place_residence')->dropDownList(
    $answers,
    [
        'class' => 'select2 width100'
    ]
);
?>
