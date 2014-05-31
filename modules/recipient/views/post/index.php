<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('recipient', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Post',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'recipient_medical_history_id',
            'date_transfusion',
            'type_transfusion',
            'personal',
            // 'number_transfusion',
            // 'arterial_pressure',
            // 'pulse',
            // 'temperature',
            // 'method_transfusion',
            // 'reaction',
            // 'has_been_reaction',
            // 'compatibility_room_temperature',
            // 'compatibility_thermal_samples',
            // 'compatibility_biological_sample',
            // 'transfusion_completion_date',
            // 'transfusion_completion_arterial_pressure',
            // 'transfusion_completion_pulse',
            // 'transfusion_completion_temperature_one_hour',
            // 'transfusion_completion_temperature_two_hour',
            // 'transfusion_completion_temperature_three_hour',
            // 'transfusion_completion_color_first_urine',
            // 'transfusion_completion_daily_urine',
            // 'transfusion_completion_id_spr_personal',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
