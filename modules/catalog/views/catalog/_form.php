<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\CancelBtn;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
?>
<div class="catalog-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?php
    if ($organizations) {
        echo $form->field($model, 'organization_id')->dropDownList($organizations,
            ['class' => 'select2 width100']);
    }
    ?>
    <?= $form->field($model, 'type')->hiddenInput()->label(''); ?>
    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo CancelBtn::widget(
            [
                'url' => $organizations ?
                        '/catalog/catalog/organization/' . $model->type :
                        '/catalog/catalog/common/' . $model->type,
            ]
        );
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>