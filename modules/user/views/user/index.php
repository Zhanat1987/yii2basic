<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;
use app\assets\JQueryUIAsset;
use app\myhelpers\Current;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\user\models\search\UserSearch $searchModel
 */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
JQueryUIAsset::register($this);
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    Pjax::begin(
        [
            'timeout' => 5000
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header' => 'Действия',
            ],
            'username',
//            'email:email',
            'surname',
            'name',
            'patronymic',
            [
                'attribute' => 'role',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'role',
                        $roles,
                        ['class' => 'select2 width-200']),
            ],
            [
                'attribute' => 'organization_id',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'organization_id',
                        $organizations,
                        ['class' => 'select2 width-200']),
            ],
            [
                'label' => $searchModel->getAttributeLabel('status'),
                'format' => 'html',
                'value' => function ($searchModel) use ($statuses) {
                        $v = '<span class="label label-' .
                            Current::getLabel($searchModel->status) . '">' .
                            $statuses[$searchModel->status] . '</span>';
                        return $v;
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        $statuses,
                        ['class' => 'select2 width-120']),
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>