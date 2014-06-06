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
                case '7' :
                    $infoColumns[] = [
                        'attribute' => 'addr_reg_addr_region_id',
                        'value' => function ($searchModel) use ($regions) {
                                return $regions[$searchModel->addr_reg_addr_region_id];
                            },
                        'filter' => Html::activeDropDownList(
                                $searchModel,
                                'addr_reg_addr_region_id',
                                $regions,
                                ['class' => 'select2 width-200']),
                    ];
                    break;
                case '8' :
                    $infoColumns[] = [
                        'attribute' => 'addr_reg_addr_city_id',
                        'value' => function ($searchModel) use ($cities) {
                                return $cities[$searchModel->addr_reg_addr_city_id];
                            },
                        'filter' => Html::activeDropDownList(
                                $searchModel,
                                'addr_reg_addr_city_id',
                                $cities,
                                ['class' => 'select2 width-200']),
                    ];
                    break;
                case '9' :
                    $infoColumns[] = [
                        'attribute' => 'addr_reg_street_id',
                        'value' => function ($searchModel) use ($streets) {
                                return $streets[$searchModel->addr_reg_street_id];
                            },
                        'filter' => Html::activeDropDownList(
                                $searchModel,
                                'addr_reg_street_id',
                                $streets,
                                ['class' => 'select2 width-200']),
                    ];
                    break;
                case '10' :
                    $infoColumns[] = 'addr_reg_home';
                    break;
                case '11' :
                    $infoColumns[] = 'addr_reg_flat';
                    break;
                case '12' :
                    $infoColumns[] = [
                        'attribute'     => 'mhNumber',
                        'label'     => $mh->getAttributeLabel('number'),
                        'value' => function ($searchModel) {
                                return is_object($searchModel->mh) ? $searchModel->mh->number : null;
                            },
                    ];
                    break;
                case '13' :
                    $infoColumns[] = [
                        'attribute'     => 'dateReceipt',
                        'label'     => $mh->getAttributeLabel('date_receipt'),
                        'value' => function ($searchModel) {
                                return is_object($searchModel->mh) ?
                                    ($searchModel->mh->date_receipt ?
                                        Yii::$app->current->getDateTime($searchModel->mh->date_receipt) : null)
                                    : null;
                            },
                        'filterOptions' => [
                            'class' => 'dateFilter',
                        ],
                    ];
                    break;
                case '14' :
                    $infoColumns[] = [
                        'attribute'     => 'dateDischarge',
                        'label'     => $mh->getAttributeLabel('date_discharge'),
                        'value' => function ($searchModel) {
                                return is_object($searchModel->mh) ?
                                    ($searchModel->mh->date_discharge ?
                                        Yii::$app->current->getDateTime($searchModel->mh->date_discharge) : null)
                                    : null;
                            },
                        'filterOptions' => [
                            'class' => 'dateFilter',
                        ],
                    ];
                    break;
                case '15' :
                    $infoColumns[] = [
                        'attribute' => 'treatmentOutcome',
                        'label'     => $mh->getAttributeLabel('treatment_outcome'),
                        'value' => function ($searchModel) use ($treatmentOutcomes) {
                                return is_object($searchModel->mh) ?
                                    ($searchModel->mh->treatment_outcome ?
                                        $treatmentOutcomes[$searchModel->mh->treatment_outcome] : null)
                                    : null;
                            },
                        'filter' => Html::activeDropDownList(
                                $searchModel,
                                'treatmentOutcome',
                                $treatmentOutcomes,
                                ['class' => 'select2 width-200']),
                    ];
                    break;
                case '16' :
                    $infoColumns[] = [
                        'attribute' => 'conveyPlaceResidence',
                        'label'     => $mh->getAttributeLabel('convey_place_residence'),
                        'value' => function ($searchModel) use ($answers) {
                                return is_object($searchModel->mh) ?
                                    ($searchModel->mh->convey_place_residence ?
                                        $answers[$searchModel->mh->convey_place_residence] : null)
                                    : null;
                            },
                        'filter' => Html::activeDropDownList(
                                $searchModel,
                                'conveyPlaceResidence',
                                $answers,
                                ['class' => 'select2 width-200']),
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
            [
                'attribute' => 'addr_reg_addr_region_id',
                'value' => function ($searchModel) use ($regions) {
                        return $regions[$searchModel->addr_reg_addr_region_id];
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'addr_reg_addr_region_id',
                        $regions,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'addr_reg_addr_city_id',
                'value' => function ($searchModel) use ($cities) {
                        return $cities[$searchModel->addr_reg_addr_city_id];
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'addr_reg_addr_city_id',
                        $cities,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'addr_reg_street_id',
                'value' => function ($searchModel) use ($streets) {
                        return $streets[$searchModel->addr_reg_street_id];
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'addr_reg_street_id',
                        $streets,
                        ['class' => 'select2 width-200']),
            ],
            'addr_reg_home',
            'addr_reg_flat',
            [
                'attribute'     => 'mhNumber',
                'label'     => $mh->getAttributeLabel('number'),
                'value' => function ($searchModel) {
                        return is_object($searchModel->mh) ? $searchModel->mh->number : null;
                    },
            ],
            [
                'attribute'     => 'dateReceipt',
                'label'     => $mh->getAttributeLabel('date_receipt'),
                'value' => function ($searchModel) {
                        return is_object($searchModel->mh) ?
                            ($searchModel->mh->date_receipt ?
                            Yii::$app->current->getDateTime($searchModel->mh->date_receipt) : null)
                            : null;
                    },
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
            [
                'attribute'     => 'dateDischarge',
                'label'     => $mh->getAttributeLabel('date_discharge'),
                'value' => function ($searchModel) {
                        return is_object($searchModel->mh) ?
                            ($searchModel->mh->date_discharge ?
                                Yii::$app->current->getDateTime($searchModel->mh->date_discharge) : null)
                            : null;
                    },
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
            [
                'attribute' => 'treatmentOutcome',
                'label'     => $mh->getAttributeLabel('treatment_outcome'),
                'value' => function ($searchModel) use ($treatmentOutcomes) {
                        return is_object($searchModel->mh) ?
                            ($searchModel->mh->treatment_outcome ?
                                $treatmentOutcomes[$searchModel->mh->treatment_outcome] : null)
                            : null;
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'treatmentOutcome',
                        $treatmentOutcomes,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'conveyPlaceResidence',
                'label'     => $mh->getAttributeLabel('convey_place_residence'),
                'value' => function ($searchModel) use ($answers) {
                        return is_object($searchModel->mh) ?
                            ($searchModel->mh->convey_place_residence ?
                                $answers[$searchModel->mh->convey_place_residence] : null)
                            : null;
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'conveyPlaceResidence',
                        $answers,
                        ['class' => 'select2 width-200']),
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