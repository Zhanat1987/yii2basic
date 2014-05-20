<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\CompPrep $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Компоненты/препараты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comps-drugs-view">
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
            [
                'label' => $model->getAttributeLabel('type'),
                'value' => $types[$model->type],
            ],
            'name',
            'short_name',
            'alert_time',
            'infodonor_id',
            'group',
            'code',
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