<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */

$this->title = $model->name;
if ($model->organization_id) {
    $this->params['breadcrumbs'][] = [
        'label' => $label,
        'url' => ['/catalog/catalog/organization/' . $model->type]
    ];
} else {
    $this->params['breadcrumbs'][] = [
        'label' => $label,
        'url' => ['/catalog/catalog/common/' . $model->type]
    ];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-view">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Редактировать'),
            ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        ?>
        <?php
        echo Html::a(Yii::t('common', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Вы уверены, что хотите удалить эту запись?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    $attributes = [
        0 => 'id',
        1 => 'name',
        3 => [
            'label' => $model->getAttributeLabel('type'),
            'value' => $types[$model->type],
        ],
        4 => [
            'label' => $model->getAttributeLabel('created_at'),
            'value' => Yii::$app->current->getDate($model->created_at),
        ],
        5 => [
            'label' => $model->getAttributeLabel('updated_at'),
            'value' => Yii::$app->current->getDate($model->updated_at),
        ],
        6 => [
            'label' => $model->getAttributeLabel('status'),
            'value' => Yii::$app->current->getStatuses($model->status),
        ],
    ];
    if ($model->organization_id) {
        $attributes[2] = [
            'label' => $model->getAttributeLabel('organization_id'),
            'value' => $organizations[$model->organization_id],
        ];
    }
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]);
    ?>
</div>