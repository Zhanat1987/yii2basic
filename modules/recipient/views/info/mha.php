<?= $form->field($model, 'hiv_1_result')->dropDownList($results, ['class' => 'select2 width100']); ?>
<?= $form->field($model, 'hiv_1_date')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?= $form->field($model, 'hiv_1_number')->textInput(['maxlength' => 250]) ?>
<?= $form->field($model, 'hiv_2_result')->dropDownList($results, ['class' => 'select2 width100']); ?>
<?= $form->field($model, 'hiv_2_date')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?= $form->field($model, 'hiv_2_number')->textInput(['maxlength' => 250]) ?>
<?= $form->field($model, 'hiv_3_result')->dropDownList($results, ['class' => 'select2 width100']); ?>
<?= $form->field($model, 'hiv_3_date')->textInput(['maxlength' => 11, 'class' => 'form-control tbDateTimePicker']) ?>
<?= $form->field($model, 'hiv_3_number')->textInput(['maxlength' => 250]) ?>