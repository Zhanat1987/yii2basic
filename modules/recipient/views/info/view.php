<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-view">

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
            'name',
            'surname',
            'patronymic',
            'sex',
            'birthday',
            'citizenship',
            'type_residence',
            'iin',
            'organization_id',
            'blood_group',
            'rh_factor',
            'document_types',
            'document_number',
            'document_series',
            'document_date_issue',
            'document_issued',
            'document_date_expiration',
            'homeless',
            'addr_reg_addr_region_id',
            'addr_reg_addr_region_area_id',
            'addr_reg_addr_city_id',
            'addr_reg_street_id',
            'addr_reg_home',
            'addr_reg_flat',
            'addr_res_addr_region_id',
            'addr_res_addr_region_area_id',
            'addr_res_addr_city_id',
            'addr_res_street_id',
            'addr_res_home',
            'addr_res_flat',
            'work_name',
            'work_department',
            'work_post',
            'work_phone',
            'user_id',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
