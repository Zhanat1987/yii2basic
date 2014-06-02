<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\bloodstorage\models\search\BloodStorageSearch $searchModel
 */

$this->title = Yii::t('bloodstorage', 'Банк КК/ПК');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="blood-storage-index">
    <div class="col-md-12">
        <div class="box border">
            <div class="box-title">
                <h4>
                    <?php echo $this->title; ?>
                </h4>
            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">
                        <li>
                            <a data-toggle="tab" href="#box_tab2">
                                <i class="fa fa-flask"></i>
                                <span class="hidden-inline-mobile">
                                    <?php echo Yii::t('bloodstorage', 'Список ПК'); ?>
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a data-toggle="tab" href="#box_tab1">
                                <i class="fa fa-home"></i>
                                <span class="hidden-inline-mobile">
                                    <?php echo Yii::t('bloodstorage', 'Список КК'); ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="box_tab1" class="tab-pane fade active in">
                            <?php
                            Pjax::begin(
                                [
                                    'timeout' => 5000,
//                                    'options' => [
//                                        'id' => 'kks',
//                                    ],
                                ]
                            );
                            echo GridView::widget([
                                'dataProvider' => $kks,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'options' => [
                                            'class' => 'actionColumn',
                                        ],
                                        'header' => 'Действия',
//                                        'template' => call_user_func(function () {
//                                            if (Yii::$app->session->get('role') == 'супер-администратор' ||
//                                                Yii::$app->session->get('role') == 'администратор') {
//                                                return '{update} {delete} {view}';
//                                            } else if (Yii::$app->session->get('role') == 'Стационар') {
//                                                return '{update} {delete}';
//                                            } else if (Yii::$app->session->get('role') == 'Центр крови') {
//                                                return '{view}';
//                                            }
//                                        }),
//                                        'buttons' => [
//                                            'delete' =>
//                                                function ($url, $searchModel) {
//                                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',
//                                                        '#', [
//                                                        'title' => Yii::t('common', 'Удалить'),
//                                                        'class' => 'deleteFromGrid',
//                                                        'confirm' => Yii::t('yii',
//                                                                'Are you sure you want to delete this item?'),
//                                                        'url' => $url
//                                                    ]);
//                                                }
//                                        ],
                                    ],
                                    'id',
                                    [
                                        'attribute'     => 'created_at',
                                        'value' => function ($searchModel) {
                                                return Yii::$app->current->getDate($searchModel->created_at);
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    [
                                        'attribute'     => 'compPrep',
                                        'label'     => Yii::t('common', 'Наименование'),
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->compPrep->name;
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'compPrep',
                                                $kksList,
                                                ['class' => 'select2 width-200 select2inBox']),
                                    ],
                                    [
                                        'attribute' => 'bloodGroup',
                                        'label'     => $body->getAttributeLabel('blood_group'),
                                        'value' => function ($searchModel) use ($bloodGroups) {
                                                return $bloodGroups[$searchModel['body']->blood_group];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'bloodGroup',
                                                $bloodGroups,
                                                ['class' => 'select2 width-200 select2inBox']),
//                                        'enableSorting' => true,
//                                        'enableSorting' => false,
                                    ],
                                    [
                                        'attribute'     => 'rhFactor',
                                        'label'     => $body->getAttributeLabel('rh_factor'),
                                        'value' => function ($searchModel) use ($rhFactors) {
                                                return $rhFactors[$searchModel['body']->rh_factor];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'rhFactor',
                                                $rhFactors,
                                                ['class' => 'select2 width-200 select2inBox']),
                                    ],
                                    [
                                        'attribute'     => 'volume',
                                        'label'     => $body->getAttributeLabel('volume'),
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->volume;
                                            },
                                    ],
                                    [
                                        'attribute'     => 'regNumber',
                                        'label'     => $body->getAttributeLabel('registration_number'),
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->registration_number;
                                            },
                                    ],
                                    [
                                        'attribute'     => 'datePrepare',
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->date_prepare;
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    [
                                        'attribute'     => 'dateExpiration',
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->date_expiration;
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    [
                                        'attribute'     => 'type_send',
                                        'value' => function ($searchModel) use ($typesSend) {
                                                return $typesSend[$searchModel->type_send];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'type_send',
                                                $typesSend,
                                                [
                                                    'class' => 'select2 width-200 select2inBox',
                                                    'id' => 'type_send',
                                                ]
                                            ),
                                    ],
                                    [
                                        'attribute'     => 'date_send',
                                        'value' => function ($searchModel) {
                                                return $searchModel->date_send ?
                                                    Yii::$app->current->getDate($searchModel->date_send) : null;
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    'document_number',
                                    [
                                        'attribute'     => 'department',
                                        'value' => function ($searchModel) use ($departments) {
                                                return $departments[$searchModel->department];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'department',
                                                $departments,
                                                [
                                                    'class' => 'select2 width-200 select2inBox',
                                                    'id' => 'department',
                                                ]
                                            ),
                                    ],
                                    [
                                        'attribute'     => 'donor',
                                        'label'     => $body->getAttributeLabel('donor'),
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->donor;
                                            },
                                    ],
                                    [
                                        'attribute'     => 'number',
                                        'label'     => $mh->getAttributeLabel('number'),
                                        'value' => function ($searchModel) {
                                                return isset($searchModel->mh) ?
                                                    $searchModel->mh->number : null;
                                            },
                                    ],
                                    [
                                        'attribute'     => 'fio',
                                        'label'     => Yii::t('common', 'ФИО реципиента'),
                                        'value' => function ($searchModel) {
                                                if (isset($searchModel->mh) && isset($searchModel->mh->info)) {
                                                    return Yii::$app->current->getInitials(
                                                        $searchModel->mh->info->surname,
                                                        $searchModel->mh->info->name,
                                                        $searchModel->mh->info->patronymic
                                                    );
                                                }
                                                return null;
                                            },
                                    ],
                                    // 'defect',
                                    // 'organization_id',
                                    // 'recipient_medical_history_id',
                                    // 'document_date_print',
                                    // 'partial_transfusion',
                                    // 'volume_transfused',
                                    // 'ids:ntext',
                                    // 'quantity',
                                    // 'type',
                                    // 'recipientkey',
                                    // 'keytime',
                                    // 'epicrisis',
                                    // 'id_cdlc_delete',
                                    // 'single_wb',
                                    // 'is_original',
                                    // 'updated_at',
                                    // 'status',
                                ],
                            ]);
                            Pjax::end();
                            ?>
                        </div>
                        <div id="box_tab2" class="tab-pane fade">
                            <?php
                            Pjax::begin(
                                [
                                    'timeout' => 5000,
//                                    'options' => [
//                                        'id' => 'pks',
//                                    ],
                                ]
                            );
                            echo GridView::widget([
                                'dataProvider' => $pks,
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
                                    'id',
                                    [
                                        'attribute'     => 'created_at',
                                        'value' => function ($searchModel) {
                                                return Yii::$app->current->getDate($searchModel->created_at);
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    [
                                        'attribute'     => 'compPrep',
                                        'label'     => Yii::t('common', 'Наименование'),
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->compPrep->name;
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'compPrep',
                                                $pksList,
                                                [
                                                    'class' => 'select2 width-200 select2inBox',
                                                    'id' => 'compPrep',
                                                ]
                                            ),
                                    ],
                                    [
                                        'attribute' => 'bloodGroup',
                                        'label'     => $body->getAttributeLabel('blood_group'),
                                        'value' => function ($searchModel, $bloodGroups) {
                                                return $bloodGroups[$searchModel['body']->blood_group];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'bloodGroup',
                                                $bloodGroups,
                                                [
                                                    'class' => 'select2 width-200 select2inBox',
                                                    'id' => 'bloodGroup',
                                                ]
                                            ),
                                    ],
                                    [
                                        'attribute'     => 'rhFactor',
                                        'label'     => $body->getAttributeLabel('rh_factor'),
                                        'value' => function ($searchModel, $rhFactors) {
                                                return $rhFactors[$searchModel['body']->rh_factor];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'rhFactor',
                                                $rhFactors,
                                                [
                                                    'class' => 'select2 width-200 select2inBox',
                                                    'id' => 'rhFactor',
                                                ]
                                            ),
                                    ],
                                    [
                                        'attribute'     => 'volume',
                                        'label'     => $body->getAttributeLabel('volume'),
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->volume;
                                            },
                                    ],
                                    [
                                        'attribute'     => 'series',
                                        'label'     => $body->getAttributeLabel('series'),
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->series;
                                            },
                                    ],
                                    [
                                        'attribute'     => 'datePrepare',
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->date_prepare;
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    [
                                        'attribute'     => 'dateExpiration',
                                        'value' => function ($searchModel) {
                                                return $searchModel->body->date_expiration;
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    [
                                        'attribute'     => 'type_send',
                                        'value' => function ($searchModel) use ($typesSend) {
                                                return $typesSend[$searchModel->type_send];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'type_send',
                                                $typesSend,
                                                [
                                                    'class' => 'select2 width-200 select2inBox',
                                                    'id' => 'type_send',
                                                ]
                                            ),
                                    ],
                                    [
                                        'attribute'     => 'date_send',
                                        'value' => function ($searchModel) {
                                                return $searchModel->date_send ?
                                                    Yii::$app->current->getDate($searchModel->date_send) : null;
                                            },
                                        'filterOptions' => [
                                            'class' => 'dateFilter',
                                        ],
                                    ],
                                    'document_number',
                                    [
                                        'attribute'     => 'department',
                                        'value' => function ($searchModel) use ($departments) {
                                                return $departments[$searchModel->department];
                                            },
                                        'filter' => Html::activeDropDownList(
                                                $searchModel,
                                                'department',
                                                $departments,
                                                [
                                                    'class' => 'select2 width-200 select2inBox',
                                                    'id' => 'department',
                                                ]
                                            ),
                                    ],
                                    [
                                        'attribute'     => 'number',
                                        'label'     => $mh->getAttributeLabel('number'),
                                        'value' => function ($searchModel) {
                                                return isset($searchModel->mh) ?
                                                    $searchModel->mh->number : null;
                                            },
                                    ],
                                    [
                                        'attribute'     => 'fio',
                                        'label'     => Yii::t('common', 'ФИО реципиента'),
                                        'value' => function ($searchModel) {
                                                if (isset($searchModel->mh) && isset($searchModel->mh->info)) {
                                                    return Yii::$app->current->getInitials(
                                                        $searchModel->mh->info->surname,
                                                        $searchModel->mh->info->name,
                                                        $searchModel->mh->info->patronymic
                                                    );
                                                }
                                                return null;
                                            },
                                    ],
                                ],
                            ]);
                            Pjax::end();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>