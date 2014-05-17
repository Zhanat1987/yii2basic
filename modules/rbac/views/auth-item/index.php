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

$this->title = 'Auth Items';
$this->params['breadcrumbs'][] = $this->title;
Select2Asset::register($this);
JQueryUIAsset::register($this);
?>
<div class="auth-item-index">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p class="pull-left">
        <?= Html::a('Create Auth Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="pull-right">
        <?php echo Html::a('Удалить текущие и создать новые все возможные разрешения',
            ['/rbac/default/generate'], ['class' => 'btn btn-info']); ?>
    </p>
    <div class="cb"></div>
    <?php
    // http://www.yiiframework.com/wiki/655/how-to-use-gridview-with-ajax/
    // https://github.com/defunkt/jquery-pjax#server-side
    Pjax::begin(
        [
            'timeout' => 5000
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => yii\grid\CheckboxColumn::className(),
                'name' => 'checkboxSingle',
                'multiple' => false,
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'deleteAll',
            ],
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'Порядковый номер'
            ],
            // http://yiiframework.ru/forum/viewtopic.php?f=19&t=17820
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
            'data:ntext',
            [
                'attribute' => 'created_at',
                'filterOptions' => [
                    'class' => 'dateFilter',
                ],
            ],
            'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
//                    'view' =>
//                        function ($url, $model) {
//                            return Html::a('<i class="fa-dot-circle-o"></i>', $url, [
//                                'title' => Yii::t('yii', 'View'),
//                                'data-pjax' => '0',
//                            ]);
//                        },
                    'delete' =>
                        function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' =>
                                    Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '1',
                            ]);
                        }
                ],
                'options' => [
                    'class' => 'actionColumn',
                ],
                'header' => 'Действия',
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>