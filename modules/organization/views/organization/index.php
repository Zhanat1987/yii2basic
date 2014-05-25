<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\organization\models\search\OrganizationSearch $searchModel
 */

$this->title = Yii::t('organization', 'Организации');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="organization-index">
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
            'short_name',
            'name',
            [
                'attribute' => 'role',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'role',
                        $roles,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'region_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'region_id',
                        $regions,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($regions) {
                        return isset($regions[$searchModel->region_id]) ?
                            $regions[$searchModel->region_id] : null;
                    },
            ],
            [
                'attribute' => 'region_area_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'region_area_id',
                        $regionAreas,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($regionAreas) {
                        return isset($regionAreas[$searchModel->region_area_id]) ?
                            $regionAreas[$searchModel->region_area_id] : null;
                    },
            ],
            [
                'attribute' => 'city_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'city_id',
                        $cities,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($cities) {
                        return isset($cities[$searchModel->city_id]) ?
                            $cities[$searchModel->city_id] : null;
                    },
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>