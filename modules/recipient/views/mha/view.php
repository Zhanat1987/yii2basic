<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MHA $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Mhas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mha-view">

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
            'hiv_1_result',
            'hiv_1_date',
            'hiv_1_number',
            'hiv_1_organization_id',
            'hiv_1_user_id',
            'hiv_2_result',
            'hiv_2_date',
            'hiv_2_number',
            'hiv_2_organization_id',
            'hiv_2_user_id',
            'hiv_3_result',
            'hiv_3_date',
            'hiv_3_number',
            'hiv_3_organization_id',
            'hiv_3_user_id',
            'status',
        ],
    ]) ?>

</div>
