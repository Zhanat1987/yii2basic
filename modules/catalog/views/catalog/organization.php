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
$this->params['breadcrumbs'][] = Yii::t('catalog', 'Общие справочники');
$this->params['breadcrumbs'][] = $title;
Select2Asset::register($this);
?>
<div class="catalog-index">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Добавить'),
            ['/catalog/catalog/create?type=organization&type_id=' . $type],
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