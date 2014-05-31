<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'homeless')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'citizenship')->textInput() ?>

    <?= $form->field($model, 'type_residence')->textInput() ?>

    <?= $form->field($model, 'iin')->textInput() ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

    <?= $form->field($model, 'blood_group')->textInput() ?>

    <?= $form->field($model, 'rh_factor')->textInput() ?>

    <?= $form->field($model, 'document_types')->textInput() ?>

    <?= $form->field($model, 'document_date_issue')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'document_date_expiration')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'addr_reg_addr_region_id')->textInput() ?>

    <?= $form->field($model, 'addr_reg_addr_region_area_id')->textInput() ?>

    <?= $form->field($model, 'addr_reg_addr_city_id')->textInput() ?>

    <?= $form->field($model, 'addr_res_addr_region_id')->textInput() ?>

    <?= $form->field($model, 'addr_res_addr_region_area_id')->textInput() ?>

    <?= $form->field($model, 'addr_res_addr_city_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'document_number')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'document_series')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'addr_reg_street_id')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'addr_reg_home')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'addr_reg_flat')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'addr_res_street_id')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'addr_res_home')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'addr_res_flat')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'work_department')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'work_post')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'work_phone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'document_issued')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'work_name')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('recipient', 'Create') : Yii::t('recipient', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="col-md-12">
    <!-- BOX -->
    <div class="box border">
        <div class="box-title">
            <h4><i class="fa fa-columns"></i><span class="hidden-inline-mobile">Tabs on Header Box</span></h4>
        </div>
        <div class="box-body">
            <div class="tabbable header-tabs">
                <ul class="nav nav-tabs">
                    <li class=""><a data-toggle="tab" href="#box_tab6"><i class="fa fa-desktop"></i> <span class="hidden-inline-mobile">Projects</span></a></li>
                    <li class=""><a data-toggle="tab" href="#box_tab5"><i class="fa fa-flask"></i> <span class="hidden-inline-mobile">Lab</span></a></li>
                    <li class="active"><a data-toggle="tab" href="#box_tab4"><i class="fa fa-home"></i> <span class="hidden-inline-mobile">Home</span> <span class="badge badge-blue font-11">3</span></a></li>
                </ul>
                <div class="tab-content">
                    <div id="box_tab4" class="tab-pane fade active in">
                        <p>Content #1</p>
                        <p> There were flying cantaloupes, rainbows and songs of happiness near by, I mean I was a little frightened by the flying fruit but I'll take this any day over prison inmates. </p>
                    </div>
                    <div id="box_tab5" class="tab-pane fade">
                        <p>Content #2</p>
                        <p> There were flying cantaloupes, rainbows and songs of happiness near by, I mean I was a little frightened by the flying fruit but I'll take this any day over prison inmates. I skipped closer and closer to the festivities and when I arrived I seen all my friends I had went to high school with there were holding hands and singing Kumbayah around the camp ice.. Yes It was a giant block of ice situated on three wood logs. </p>
                    </div>
                    <div id="box_tab6" class="tab-pane fade">
                        <div class="alert alert-info"><strong>Hello!</strong> I'm a cool tabbed box.</div>
                        <p>Content #3</p>
                        <p> Duis autem vel eum iriure dolor. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /BOX -->
</div>