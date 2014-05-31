<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('recipient', 'Mhs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mh-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Mh',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'recipient_info_id',
            'number',
            'date_receipt',
            'mkb10',
            // 'hiv_testing',
            // 'hiv_number',
            // 'date_discharge',
            // 'treatment_outcome',
            // 'personal',
            // 'convey_place_residence',
            // 'date_transmission_recipient',
            // 'receiver',
            // 'created_at',
            // 'updated_at',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
