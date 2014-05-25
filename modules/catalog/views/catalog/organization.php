<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\catalog\models\search\CatalogSearch $searchModel
 */

$this->title = $title;
$this->params['breadcrumbs'][] = Yii::t('catalog', 'Справочники по организациям');
$this->params['breadcrumbs'][] = $title;
Select2Asset::register($this);
?>
<div class="catalog-index">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Добавить'),
            ["/catalog/catalog/{$type}/create"],
            ['class' => 'btn btn-success']
        );
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
            'name',
            [
                'attribute' => 'organization_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'organization_id',
                        $organizations,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($organizations) {
                        return $organizations[$searchModel->organization_id];
                    }
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>