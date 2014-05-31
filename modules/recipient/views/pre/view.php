<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\PRE $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Pres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-view">

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
            'indications_transfusion',
            'date_transfusion',
            'personal',
            'bcc',
            'height',
            'weight',
            'general_condition',
            'skin',
            'statement',
            'comps_drugs:ntext',
            'comps_drugs_count',
            'massive_blood_loss',
            'reason',
            'deficit_bcc',
            'hemorrhage',
            'arterial_pressure',
            'pulse',
            'temperature',
            'date_uac',
            'hb',
            'ht',
            'erythrocytes',
            'stage_dic_syndromes',
            'stage_dic_syndromes_reason',
            'date_coagulation',
            'aptt',
            'ptv',
            'pti',
            'fibrinogen',
            'sfmc',
            'fibrinolysis',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
