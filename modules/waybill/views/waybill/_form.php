<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\CancelBtn;
use app\widgets\Request;
use app\assets\WaybillAsset;

/**
 * @var yii\web\View $this
 * @var app\modules\waybill\models\Header $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);

WaybillAsset::register($this);

if (Yii::$app->controller->action->id == 'view') {
    $this->registerJs("disabledForm('waybill-form', '/waybill/waybill/index');");
} else if ($errors) {
    echo \app\widgets\Errors::widget(['errors' => $errors]);
}
?>
<div class="header-form">
    <?php $form = ActiveForm::begin([
        'validateOnChange' => false,
        'validateOnSubmit' => false,
        'options' => [
            'id' => 'waybill-form',
        ]
    ]); ?>
    <?= $form->field($model, 'number')->textInput(['maxlength' => 11, 'onkeyup' => 'onlyDigits(this)']) ?>
    <?php
    echo $form->field($model, 'date')->textInput(
        [
            'maxlength' => 11,
            'class' => 'form-control tbDateTimePicker'
        ]
    );
    ?>
    <?= $form->field($model, 'sender')->dropDownList($organizations, ['class' => 'select2 width100']); ?>
    <?php
    echo Request::widget(
        [
            'value' => $model->request,
            'label' => $model->getAttributeLabel('request'),
        ]
    );
    ?>
    <?php
    if (Yii::$app->session->get('role') == 'супер-администратор' ||
        Yii::$app->session->get('role') == 'администратор') {
        echo $form->field($model, 'organization_id')->dropDownList($organizationIds, ['class' => 'select2 width100']);
    }
    ?>
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
        if (Yii::$app->controller->action->id != 'view') {
            echo CancelBtn::widget(
                [
                    'url' => '/waybill/waybill/index',
                ]
            );
        }
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>