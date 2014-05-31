<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('recipient', 'Mhas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mha-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Mha',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'recipient_medical_history_id',
            'hiv_1_result',
            'hiv_1_date',
            'hiv_1_number',
            // 'hiv_1_organization_id',
            // 'hiv_1_user_id',
            // 'hiv_2_result',
            // 'hiv_2_date',
            // 'hiv_2_number',
            // 'hiv_2_organization_id',
            // 'hiv_2_user_id',
            // 'hiv_3_result',
            // 'hiv_3_date',
            // 'hiv_3_number',
            // 'hiv_3_organization_id',
            // 'hiv_3_user_id',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
