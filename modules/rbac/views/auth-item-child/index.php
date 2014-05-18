<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\rbac\models\search\AuthItemChildSearch $searchModel
 */

$this->title = Yii::t('rbac', 'Иерархия');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="auth-item-child-index">
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class'   => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header'  => 'Действия',
            ],
            [
                'attribute' => 'parent',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'parent',
                        $authItems,
                        ['class' => 'select2 width-400']),
            ],
            [
                'attribute' => 'child',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'child',
                        $authItems,
                        ['class' => 'select2 width-400']),
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>