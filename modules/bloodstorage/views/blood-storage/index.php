<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\bloodstorage\models\search\BloodStorageSearch $searchModel
 */

$this->title = Yii::t('bloodstorage', 'Blood Storages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blood-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('bloodstorage', 'Create {modelClass}', [
    'modelClass' => 'Blood Storage',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
    ]); ?>

</div>
