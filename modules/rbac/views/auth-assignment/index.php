<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\rbac\models\search\AuthAssignmentSearch $searchModel
 */

$this->title = 'Auth Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Присвоение ролей и разрешений ('item_name' - внешний ключ к таблице 'auth_item')
        пользователям ('user_id' -  - внешний ключ к таблице 'user').
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Auth Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_name',
            'user_id',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
