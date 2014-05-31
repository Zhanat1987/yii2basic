<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MH $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Mhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mh-view">

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
            'recipient_info_id',
            'number',
            'date_receipt',
            'mkb10',
            'hiv_testing',
            'hiv_number',
            'date_discharge',
            'treatment_outcome',
            'personal',
            'convey_place_residence',
            'date_transmission_recipient',
            'receiver',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
