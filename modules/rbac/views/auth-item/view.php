<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItem $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Роли и разрешения'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Редактировать'),
            ['update', 'id' => $model->name], ['class' => 'btn btn-primary']);
        ?>
        <?php
        echo Html::a(Yii::t('common', 'Удалить'),
            ['delete', 'id' => $model->name], [
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
            'name',
            [
                'label' => $model->getAttributeLabel('type'),
                'value' => $types[$model->type],
            ],
            'description:ntext',
            'rule_name',
            'data:ntext',
            [
                'label' => $model->getAttributeLabel('created_at'),
                'value' => Yii::$app->current->getDate($model->created_at),
            ],
            [
                'label' => $model->getAttributeLabel('updated_at'),
                'value' => Yii::$app->current->getDate($model->updated_at),
            ],
        ],
    ]);
    ?>
</div>