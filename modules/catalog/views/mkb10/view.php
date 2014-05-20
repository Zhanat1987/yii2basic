<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Mkb10 $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'МКБ 10'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkb10-view">
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'f1',
            'f2',
            'f3',
            'icd10',
            'diagnosis',
            [
                'label' => $model->getAttributeLabel('created_at'),
                'value' => Yii::$app->current->getDate($model->created_at),
            ],
            [
                'label' => $model->getAttributeLabel('updated_at'),
                'value' => Yii::$app->current->getDate($model->updated_at),
            ],
            [
                'label' => $model->getAttributeLabel('status'),
                'value' => Yii::$app->current->getStatuses($model->status),
            ],
        ],
    ]);
    ?>
</div>