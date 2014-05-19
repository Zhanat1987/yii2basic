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

$this->title = Yii::t('catalog', 'Общие справочники');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="catalog-index">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Добавить'),
            ['/catalog/catalog/create?type=common'], ['class' => 'btn btn-success']);
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
            'name',
            [
                'attribute' => 'type',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'type',
                        $common,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($common) {
                        return $common[$searchModel->type];
                    }
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>