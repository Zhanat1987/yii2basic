<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;
use app\assets\JQueryUIAsset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\rbac\models\search\AuthItemSearch $searchModel
 */

$this->title = Yii::t('rbac', 'Правила');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
JQueryUIAsset::register($this);
?>
<div class="auth-item-index">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Добавить'),
            ['create'], ['class' => 'btn btn-success']);
        ?>
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
        'options' => [
            'id' => 'authItemGrid'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header' => 'Действия',
            ],
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function ($searchModel) {
                    return Html::a($searchModel['name'], ['update', 'id' => $searchModel['name']]);
                }
            ],
            [
                'label' => $searchModel->getAttributeLabel('type'),
                'value' => function ($searchModel) {
                    return $searchModel->getTypes($searchModel->type);
                },
                'filter' => Html::activeDropDownList($searchModel, 'type',
                        $searchModel->getTypesForGridFilter(), ['class' => 'select2 width-100']),
            ],
            'description:ntext',
            'rule_name',
            [
                'attribute'     => 'created_at',
                'value' => function ($searchModel) {
                        return Yii::$app->current->getDate($searchModel->created_at);
                    },
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>