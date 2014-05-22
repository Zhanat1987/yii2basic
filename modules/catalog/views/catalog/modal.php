<button type="button" class="btn btn-success">
    <i class="fa fa-plus"></i>
    <?php echo \Yii::t('common', 'Добавить'); ?>
</button>
<button type="button" class="btn btn-info">
    <i class="fa fa-trash-o"></i>
    <?php echo \Yii::t('common', 'Удалить'); ?>
</button>
<?php

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view',
        'phrase' => $searchModel->nameM,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => yii\grid\CheckboxColumn::className(),
            'name' => 'checkboxSingle',
            'multiple' => false,
            'options' => [
                'class' => 'width-20',
            ],
        ],
        'name',
    ],
]);