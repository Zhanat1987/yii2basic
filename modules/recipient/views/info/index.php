<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;
use app\widgets\RecipientColumns;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\recipient\models\search\InfoSearch $searchModel
 */

$this->title = Yii::t('recipient', 'Реципиенты');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="info-index">
    <?php if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'супер-администратор' ||
        Yii::$app->getRequest()->getCookies()->getValue('role') == 'администратор' ||
        Yii::$app->getRequest()->getCookies()->getValue('role') == 'Стационар') : ?>
        <p>
            <?php
            echo Html::a(Yii::t('common', 'Добавить'),
                ['create'], ['class' => 'btn btn-success']);
            ?>
        </p>
    <?php endif; ?>
    <?php
    echo RecipientColumns::widget(['grid' => 'w1']);
    if ($columns) {
        $infoColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header' => 'Действия',
                'template' => call_user_func(function () {
                    if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'супер-администратор' ||
                        Yii::$app->getRequest()->getCookies()->getValue('role') == 'администратор') {
                        return '{update} {delete} {view}';
                    } else if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'Стационар') {
                        return '{update} {delete}';
                    } else {
                        return '{view}';
                    }
                }),
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
            ]
        ];
        foreach ($columns as $column) {
            switch ($column) {
                case '1' :
                    $infoColumns[] = 'id';
                    break;
                case '2' :
                    $infoColumns[] = [
                        'attribute'     => 'created_at',
                        'filterOptions' => [
                            'class' => 'dateFilter',
                        ],
                    ];
                    break;
                case '3' :
                    $infoColumns[] = 'name';
                    break;
                case '4' :
                    $infoColumns[] = 'surname';
                    break;
                case '5' :
                    $infoColumns[] = 'patronymic';
                    break;
                case '6' :
                    $infoColumns[] = [
                        'attribute'     => 'birthday',
                        'filterOptions' => [
                            'class' => 'dateFilter',
                        ],
                    ];
                    break;
            }
        }
    } else {
        $infoColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header' => 'Действия',
                'template' => call_user_func(function () {
                    if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'супер-администратор' ||
                        Yii::$app->getRequest()->getCookies()->getValue('role') == 'администратор') {
                        return '{update} {delete} {view}';
                    } else if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'Стационар') {
                        return '{update} {delete}';
                    } else {
                        return '{view}';
                    }
                }),
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
            'id',
            [
                'attribute'     => 'created_at',
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
            'name',
            'surname',
            'patronymic',
            [
                'attribute'     => 'birthday',
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
        ];
    }
    ?>
    <?php
    Pjax::begin(
        [
            'timeout' => 5000
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $infoColumns,
    ]);
    Pjax::end();
    ?>
</div>