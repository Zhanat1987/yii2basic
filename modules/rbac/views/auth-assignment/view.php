<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\myhelpers\Current;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthAssignment $model
 */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-view">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?php
        echo Html::a('Update',
            [
                'update',
                'item_name' => $model->item_name,
                'user_id'   => $model->user_id
            ],
            ['class' => 'btn btn-primary']
        );
        ?>
        <?php
        echo Html::a('Delete',
            [
                'delete',
                'item_name' => $model->item_name,
                'user_id'   => $model->user_id
            ],
            [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => 'Are you sure you want to delete this item?',
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
                'value' => Current::getDate($model->created_at),
            ],
        ],
    ]);
    ?>
</div>