<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\myhelpers\Current;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Редактировать'),
            ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        ?>
        <?php
        echo Html::a(Yii::t('common', 'Удалить'),
            ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Вы уверены, что хотите удалить эту запись?'),
                'method' => 'post',
            ],
        ]);
        ?>
    </p>
    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'surname',
            'name',
            'patronymic',
            'role',
            [
                'label' => $model->getAttributeLabel('status'),
                'value' => $statuses[$model->status],
            ],
            'department',
            'post',
            [
                'label' => $model->getAttributeLabel('created_at'),
                'value' => Current::getDate($model->created_at),
            ],
            [
                'label' => $model->getAttributeLabel('updated_at'),
                'value' => Current::getDate($model->updated_at),
            ],
        ],
    ]);
    ?>
</div>