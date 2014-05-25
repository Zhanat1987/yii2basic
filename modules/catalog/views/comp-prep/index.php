<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\catalog\models\search\CompPrepSearch $searchModel
 */

$this->title = Yii::t('catalog', 'Компоненты/препараты');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="comps-drugs-index">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Добавить'),
            ['create'], ['class' => 'btn btn-success']);
        ?>
    </p>
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
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header' => 'Действия',
                'buttons' => [
                    'delete' =>
                        function ($url, $searchModel) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                                'title' => Yii::t('common', 'Удалить'),
                                'class' => 'deleteFromGrid',
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'url' => $url
                            ]);
                        }
                ],
            ],
            [
                'header' => 'Тип',
                'attribute' => 'type',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'type',
                        $types,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($types) {
                        return $types[$searchModel->type];
                    }
            ],
            [
                'header' => 'Наименование',
                'value' => function ($searchModel) {
                        return $searchModel->name;
                    },
            ],
            [
                'header' => 'Сокр-е наим-е',
                'value' => function ($searchModel) {
                        return $searchModel->short_name;
                    },
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>