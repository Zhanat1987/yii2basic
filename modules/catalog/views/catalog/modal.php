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
        'name',
    ],
]);