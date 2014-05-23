<?php if ($model) : ?>
    <button type="button" class="btn btn-success">
        <i class="fa fa-plus"></i>
        <?php echo \Yii::t('common', 'Добавить'); ?>
    </button>
    <button type="button" class="btn btn-info selectBtnInfo" disabled="disabled">
        <i class="fa fa-trash-o"></i>
        <?php echo \Yii::t('common', 'Удалить'); ?>
    </button>
    <div class="divide-20"></div>
    <div class="modal fade catalogM bs-example-modal-sm">
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
                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'options' => [
                            'id' => 'catalogM',
                        ]
                    ]); ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
                    <?= $form->field($model, 'type')->hiddenInput()->label(false); ?>
                    <?php \yii\widgets\ActiveForm::end(); ?>
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
<?php endif; ?>
<?php
$columns = [
    ['class' => '\yii\grid\SerialColumn'],
    [
        'class' => \yii\grid\CheckboxColumn::className(),
        'name' => 'checkboxSingle',
        'multiple' => false,
        'options' => [
            'class' => 'width-20',
        ],
    ]
];
if ($model) {
    $columns[] = [
        'class' => \dosamigos\grid\EditableColumn::className(),
        'attribute' => 'name',
        'url' => ['/catalog/catalog/editable'],
        'type' => 'text',
        'editableOptions' => [
            'mode' => 'inline',
        ]
    ];
} else {
    $columns[] = 'name';
}
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view',
        'phrase' => $searchModel->nameM,
        'id' => 'catalogGrid',
    ],
    'columns' => $columns,
]);