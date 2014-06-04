<?= $form->field($model, 'recipient_medical_history_id')->textInput() ?>

<?= $form->field($model, 'indications_transfusion')->textInput() ?>

<?= $form->field($model, 'date_transfusion')->textInput(['maxlength' => 11]) ?>

<?= $form->field($model, 'personal')->textInput() ?>

<?= $form->field($model, 'bcc')->textInput() ?>

<?= $form->field($model, 'height')->textInput() ?>

<?= $form->field($model, 'weight')->textInput() ?>

<?= $form->field($model, 'general_condition')->textInput() ?>

<?= $form->field($model, 'skin')->textInput() ?>

<?= $form->field($model, 'statement')->textInput() ?>

<?= $form->field($model, 'comps_drugs_count')->textInput() ?>

<?= $form->field($model, 'massive_blood_loss')->textInput() ?>

<?= $form->field($model, 'deficit_bcc')->textInput() ?>

<?= $form->field($model, 'hemorrhage')->textInput() ?>

<?= $form->field($model, 'date_uac')->textInput(['maxlength' => 11]) ?>

<?= $form->field($model, 'date_coagulation')->textInput(['maxlength' => 11]) ?>

<?= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

<?= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

<?= $form->field($model, 'comps_drugs')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'reason')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'arterial_pressure')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'pulse')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'temperature')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'hb')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'ht')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'erythrocytes')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'stage_dic_syndromes')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'stage_dic_syndromes_reason')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'aptt')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'ptv')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'pti')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'fibrinogen')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'sfmc')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'fibrinolysis')->textInput(['maxlength' => 50]) ?>