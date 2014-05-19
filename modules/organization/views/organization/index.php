<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\organization\models\search\OrganizationSearch $searchModel
 */

$this->title = Yii::t('organization', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('organization', 'Create {modelClass}', [
  'modelClass' => 'Organization',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'short_name',
            'region_id',
            'region_area_id',
            // 'city_id',
            // 'street_id',
            // 'home_number',
            // 'phone',
            // 'email:email',
            // 'url:url',
            // 'chief_phone',
            // 'chief_email:email',
            // 'infodonor_id',
            // 'bin',
            // 'curl:url',
            // 'created_at',
            // 'updated_at',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
