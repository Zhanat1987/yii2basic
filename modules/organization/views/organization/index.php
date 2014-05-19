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
            ],
            'short_name',
            'name',
            [
                'attribute' => 'region_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'region_id',
                        $regions,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'region_area_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'region_area_id',
                        $regionAreas,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'city_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'city_id',
                        $cities,
                        ['class' => 'select2 width-200']),
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>