<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\request\models\Header $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('request', 'Headers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('request', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('request', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('request', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'request_date',
            'urgency',
            'type',
            'personal',
            'target',
            'receiver',
            'execution_date',
            'required_date',
            'request_status',
            'user_id',
            'organization_id',
            'was_read',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
