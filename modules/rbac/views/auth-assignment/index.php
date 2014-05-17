<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;
use app\assets\JQueryUIAsset;
use app\myhelpers\Current;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\rbac\models\search\AuthAssignmentSearch $searchModel
 */

$this->title = 'Auth Assignments';
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
JQueryUIAsset::register($this);
?>
<div class="auth-assignment-index">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Auth Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    Pjax::begin(
        [
            'timeout' => 5000
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class'   => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header'  => 'Действия',
            ],
            [
                'attribute' => 'item_name',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'item_name',
                        $authItems,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($searchModel) {
                        return $searchModel->user->username;
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'user_id',
                        $users,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute'     => 'created_at',
                'value' => function ($searchModel) {
                        return Current::getDate($searchModel->created_at);
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