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
                                    'id',
                                    'waybill_body_id',
                                    'type_send',
                                    'date_send',
                                    'department',
                                    // 'defect',
                                    // 'organization_id',
                                    // 'recipient_medical_history_id',
                                    // 'document_number',
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
                                    // 'created_at',
                                    // 'updated_at',
                                    // 'status',

                                    ['class' => 'yii\grid\ActionColumn'],
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
                                    'id',
                                    'waybill_body_id',
                                    'type_send',
                                    'date_send',
                                    'department',
                                    // 'defect',
                                    // 'organization_id',
                                    // 'recipient_medical_history_id',
                                    // 'document_number',
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
                                    // 'created_at',
                                    // 'updated_at',
                                    // 'status',

                                    ['class' => 'yii\grid\ActionColumn'],
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