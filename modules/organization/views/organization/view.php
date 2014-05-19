<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('organization', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('organization', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('organization', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('organization', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'short_name',
            'region_id',
            'region_area_id',
            'city_id',
            'street_id',
            'home_number',
            'phone',
            'email:email',
            'url:url',
            'chief_phone',
            'chief_email:email',
            'infodonor_id',
            'bin',
            'curl:url',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
