<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('recipient', 'Pres');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Pre',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'recipient_medical_history_id',
            'indications_transfusion',
            'date_transfusion',
            'personal',
            // 'bcc',
            // 'height',
            // 'weight',
            // 'general_condition',
            // 'skin',
            // 'statement',
            // 'comps_drugs:ntext',
            // 'comps_drugs_count',
            // 'massive_blood_loss',
            // 'reason',
            // 'deficit_bcc',
            // 'hemorrhage',
            // 'arterial_pressure',
            // 'pulse',
            // 'temperature',
            // 'date_uac',
            // 'hb',
            // 'ht',
            // 'erythrocytes',
            // 'stage_dic_syndromes',
            // 'stage_dic_syndromes_reason',
            // 'date_coagulation',
            // 'aptt',
            // 'ptv',
            // 'pti',
            // 'fibrinogen',
            // 'sfmc',
            // 'fibrinolysis',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
