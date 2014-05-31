<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\POST $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('recipient', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('recipient', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('recipient', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'recipient_medical_history_id',
            'date_transfusion',
            'type_transfusion',
            'personal',
            'number_transfusion',
            'arterial_pressure',
            'pulse',
            'temperature',
            'method_transfusion',
            'reaction',
            'has_been_reaction',
            'compatibility_room_temperature',
            'compatibility_thermal_samples',
            'compatibility_biological_sample',
            'transfusion_completion_date',
            'transfusion_completion_arterial_pressure',
            'transfusion_completion_pulse',
            'transfusion_completion_temperature_one_hour',
            'transfusion_completion_temperature_two_hour',
            'transfusion_completion_temperature_three_hour',
            'transfusion_completion_color_first_urine',
            'transfusion_completion_daily_urine',
            'transfusion_completion_id_spr_personal',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
