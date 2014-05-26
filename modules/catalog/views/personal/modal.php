<?php

use app\assets\PersonalAsset;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use dosamigos\grid\EditableColumn;
use yii\grid\CheckboxColumn;

PersonalAsset::register($this);
?>
<button type="button" class="btn btn-success">
    <i class="fa fa-plus"></i>
    <?php echo \Yii::t('common', 'Добавить'); ?>
</button>
<button type="button" class="btn btn-info personalBtnInfo" disabled="disabled">
    <i class="fa fa-trash-o"></i>
    <?php echo \Yii::t('common', 'Удалить'); ?>
</button>
<div class="divide-20"></div>
<?php
$paramsAttr = '';
if ($params) {
    foreach ($params['PersonalSearch'] as $k => $v) {
        $paramsAttr .= ' ' . $k . '="' . $v . '"';
    }
}
?>
<div class="filterAfterAjax"<?php echo $paramsAttr; ?>></div>
<div class="modal fade personalM bs-example-modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <?php echo \Yii::t('common', 'Информация'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'validateOnChange' => false,
                    'options' => [
                        'id' => 'personalM',
                    ]
                ]); ?>
                <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($model, 'patronimic')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($model, 'post')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($model, 'department')->textInput(['maxlength' => 255]) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <?php echo \Yii::t('common', 'Сохранить'); ?>
                </button>
                <button type="button" class="btn btn-danger">
                    <?php echo \Yii::t('common', 'Отменить'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view',
        'id' => 'personalGrid',
    ],
    'columns' => [
        ['class' => '\yii\grid\SerialColumn'],
        [
            'class' => CheckboxColumn::className(),
            'name' => 'checkboxSingle',
            'multiple' => false,
            'options' => [
                'class' => 'width-20',
            ],
        ],
        [
            'class' => EditableColumn::className(),
            'attribute' => 'surname',
            'url' => ['/catalog/personal/editable'],
            'type' => 'text',
            'editableOptions' => [
                'mode' => 'inline',
            ]
        ],
        [
            'class' => EditableColumn::className(),
            'attribute' => 'name',
            'url' => ['/catalog/personal/editable'],
            'type' => 'text',
            'editableOptions' => [
                'mode' => 'inline',
            ]
        ],
        [
            'class' => EditableColumn::className(),
            'attribute' => 'patronimic',
            'url' => ['/catalog/personal/editable'],
            'type' => 'text',
            'editableOptions' => [
                'mode' => 'inline',
            ]
        ],
        [
            'class' => EditableColumn::className(),
            'attribute' => 'post',
            'url' => ['/catalog/personal/editable'],
            'type' => 'text',
            'editableOptions' => [
                'mode' => 'inline',
            ]
        ],
        [
            'class' => EditableColumn::className(),
            'attribute' => 'department',
            'url' => ['/catalog/personal/editable'],
            'type' => 'text',
            'editableOptions' => [
                'mode' => 'inline',
            ]
        ],
    ],
]);