<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MHST $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Mhsts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhst-view">

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
            'date_send',
            'date_receive',
            'receiver',
            'user_id',
            'organization_id',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
