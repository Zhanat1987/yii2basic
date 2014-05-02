<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\user\models\search\UserSearch $searchModel
 */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'email:email',
            'rbac_role_name',
            [
//                'class' => DataColumn::className(),
                'attribute' => 'rbac_role_name',
                'format' => 'text',
                'label' => 'Name',
//                'value' => 'test',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>