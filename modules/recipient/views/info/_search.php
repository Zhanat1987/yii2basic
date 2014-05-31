<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\search\InfoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'patronymic') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'citizenship') ?>

    <?php // echo $form->field($model, 'type_residence') ?>

    <?php // echo $form->field($model, 'iin') ?>

    <?php // echo $form->field($model, 'organization_id') ?>

    <?php // echo $form->field($model, 'blood_group') ?>

    <?php // echo $form->field($model, 'rh_factor') ?>

    <?php // echo $form->field($model, 'document_types') ?>

    <?php // echo $form->field($model, 'document_number') ?>

    <?php // echo $form->field($model, 'document_series') ?>

    <?php // echo $form->field($model, 'document_date_issue') ?>

    <?php // echo $form->field($model, 'document_issued') ?>

    <?php // echo $form->field($model, 'document_date_expiration') ?>

    <?php // echo $form->field($model, 'homeless') ?>

    <?php // echo $form->field($model, 'addr_reg_addr_region_id') ?>

    <?php // echo $form->field($model, 'addr_reg_addr_region_area_id') ?>

    <?php // echo $form->field($model, 'addr_reg_addr_city_id') ?>

    <?php // echo $form->field($model, 'addr_reg_street_id') ?>

    <?php // echo $form->field($model, 'addr_reg_home') ?>

    <?php // echo $form->field($model, 'addr_reg_flat') ?>

    <?php // echo $form->field($model, 'addr_res_addr_region_id') ?>

    <?php // echo $form->field($model, 'addr_res_addr_region_area_id') ?>

    <?php // echo $form->field($model, 'addr_res_addr_city_id') ?>

    <?php // echo $form->field($model, 'addr_res_street_id') ?>

    <?php // echo $form->field($model, 'addr_res_home') ?>

    <?php // echo $form->field($model, 'addr_res_flat') ?>

    <?php // echo $form->field($model, 'work_name') ?>

    <?php // echo $form->field($model, 'work_department') ?>

    <?php // echo $form->field($model, 'work_post') ?>

    <?php // echo $form->field($model, 'work_phone') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('recipient', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('recipient', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
