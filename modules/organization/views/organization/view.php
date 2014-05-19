<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('organization', 'Организации'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-view">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Редактировать'),
            ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        ?>
        <?php
        echo Html::a(Yii::t('common', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Вы уверены, что хотите удалить эту запись?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'short_name',
            [
                'label' => $model->getAttributeLabel('region_id'),
                'value' => isset($regions[$model->region_id]) ? $regions[$model->region_id] : null,
            ],
            [
                'label' => $model->getAttributeLabel('region_area_id'),
                'value' => isset($regionAreas[$model->region_area_id]) ?
                        $regionAreas[$model->region_area_id] : null,
            ],
            [
                'label' => $model->getAttributeLabel('city_id'),
                'value' => isset($cities[$model->city_id]) ? $cities[$model->city_id] : null,
            ],
            [
                'label' => $model->getAttributeLabel('street_id'),
                'value' => isset($streets[$model->street_id]) ? $streets[$model->street_id] : null,
            ],
            'home_number',
            'phone',
            'email:email',
            'url:url',
            'chief_phone',
            'chief_email:email',
            'infodonor_id',
            'bin',
            'curl:url',
            [
                'label' => $model->getAttributeLabel('created_at'),
                'value' => Yii::$app->current->getDate($model->created_at),
            ],
            [
                'label' => $model->getAttributeLabel('updated_at'),
                'value' => Yii::$app->current->getDate($model->updated_at),
            ],
            [
                'label' => $model->getAttributeLabel('status'),
                'value' => Yii::$app->current->getStatuses($model->status),
            ],
        ],
    ]);
    ?>
</div>