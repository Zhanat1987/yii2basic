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

$this->title = 'Auth Rules';
$this->params['breadcrumbs'][] = $this->title;
JQueryUIAsset::register($this);
?>
<div class="auth-rule-index">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Auth Rule', ['create'], ['class' => 'btn btn-success']) ?>
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