<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\assets\Select2Asset;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\recipient\models\search\InfoSearch $searchModel
 */

$this->title = Yii::t('recipient', 'Реципиенты');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
?>
<div class="info-index">
    <?php if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'супер-администратор' ||
        Yii::$app->getRequest()->getCookies()->getValue('role') == 'администратор' ||
        Yii::$app->getRequest()->getCookies()->getValue('role') == 'Стационар') : ?>
        <p>
            <?php
            echo Html::a(Yii::t('common', 'Добавить'),
                ['create'], ['class' => 'btn btn-success']);
            ?>
        </p>
    <?php endif; ?>
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
                'template' => call_user_func(function () {
                    if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'супер-администратор' ||
                        Yii::$app->getRequest()->getCookies()->getValue('role') == 'администратор') {
                        return '{update} {delete} {view}';
                    } else if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'Стационар') {
                        return '{update} {delete}';
                    } else {
                        return '{view}';
                    }
                }),
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
                'attribute'     => 'created_at',
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
            'name',
            'surname',
            'patronymic',
            [
                'attribute'     => 'birthday',
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>