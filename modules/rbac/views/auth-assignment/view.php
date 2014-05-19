<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthAssignment $model
 */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('rbac', 'Назначить права доступа'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-view">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Редактировать'),
            [
                'update',
                'item_name' => $model->item_name,
                'user_id'   => $model->user_id
            ],
            ['class' => 'btn btn-primary']
        );
        ?>
        <?php
        echo Html::a(Yii::t('common', 'Удалить'),
            [
                'delete',
                'item_name' => $model->item_name,
                'user_id'   => $model->user_id
            ],
            [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => Yii::t('common', 'Вы уверены, что хотите удалить эту запись?'),
                    'method'  => 'post',
                ],
            ]);
        ?>
    </p>
    <?php
    echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'item_name',
            [
                'label' => $model->getAttributeLabel('user_id'),
                'value' => $users[$model->user_id],
            ],
            [
                'label' => $model->getAttributeLabel('created_at'),
                'value' => Yii::$app->current->getDate($model->created_at),
            ],
        ],
    ]);
    ?>
</div>