<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\request\models\search\HeaderSearch $searchModel
 */

$this->title = Yii::t('request', 'Заявки');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="header-index">
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
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header' => 'Действия',
                'template' => Yii::$app->session->get('role') == 'Стационар' ?
                        '{update} {delete}' : '{view}',
                'buttons' => [
                    'delete' =>
                        function ($url, $searchModel) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                                'title' => Yii::t('common', 'Удалить'),
                                'class' => 'deleteFromGrid',
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'url' => $url
                            ]);
                        }
                ],
            ],
            'id',
            [
                'attribute'     => 'request_date',
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
            [
                'attribute' => 'receiver',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'receiver',
                        $organizations,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($organizations) {
                        return $organizations[$searchModel->receiver];
                    },
            ],
            [
                'attribute' => 'personal',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'personal',
                        $personal,
                        ['class' => 'select2 width-200']),
                'value' => function ($searchModel) use ($personal) {
                        return $personal[$searchModel->personal];
                    },
            ],
            Yii::$app->session->get('role') == 'Стационар' ?
            [
                'label' => $searchModel->getAttributeLabel('request_status'),
                'format' => 'html',
                'value' => function ($searchModel) use ($statuses) {
                        $v = '<span class="label label-' .
                            Yii::$app->current->getLabel($searchModel->request_status) . '">' .
                            $statuses[$searchModel->request_status] . '</span>';
                        return $v;
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'request_status',
                        $statuses,
                        ['class' => 'select2 width-150']),
            ]
            :
            [
                'label' => $searchModel->getAttributeLabel('was_read'),
                'format' => 'html',
                'value' => function ($searchModel) use ($wasRead) {
                        $v = '<span class="label label-' .
                            Yii::$app->current->getLabel($searchModel->was_read) . '">' .
                            $wasRead[$searchModel->was_read] . '</span>';
                        return $v;
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'was_read',
                        $wasRead,
                        ['class' => 'select2 width-150']),
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>