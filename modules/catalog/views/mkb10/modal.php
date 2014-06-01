<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\CheckboxColumn;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\catalog\models\search\Mkb10Search $searchModel
 */
?>
<div class="mkb10-index">
    <?php
    Pjax::begin(
        [
            'timeout' => 5000
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => CheckboxColumn::className(),
                'name' => 'checkboxSingle',
                'multiple' => false,
                'options' => [
                    'class' => 'width-20',
                ],
            ],
            'icd10',
            'diagnosis',
        ],
    ]);
    Pjax::end();
    ?>
</div>