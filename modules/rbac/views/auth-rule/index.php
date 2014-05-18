<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\JQueryUIAsset;
use app\myhelpers\Current;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\rbac\models\search\AuthRuleSearch $searchModel
 */

$this->title = Yii::t('rbac', 'Роли и разрешения');
$this->params['breadcrumbs'][] = $this->title;
JQueryUIAsset::register($this);
?>
<div class="auth-rule-index">
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
                'class'   => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header'  => 'Действия',
            ],
            'name',
            [
                'attribute'     => 'created_at',
                'value' => function ($searchModel) {
                        return Current::getDate($searchModel->created_at);
                    },
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
            [
                'attribute'     => 'updated_at',
                'value' => function ($searchModel) {
                        return Current::getDate($searchModel->updated_at);
                    },
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>