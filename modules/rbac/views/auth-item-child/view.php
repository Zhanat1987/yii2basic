<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\rbac\models\AuthItemChild $model
 */

$this->title = $model->parent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Иерархия'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-view">
    <p>
        <?php
        echo Html::a(Yii::t('common', 'Редактировать'),
            ['update', 'parent' => $model->parent, 'child' => $model->child],
            ['class' => 'btn btn-primary']);
        ?>
        <?php
        echo Html::a(Yii::t('common', 'Удалить'),
            ['delete', 'parent' => $model->parent, 'child' => $model->child], [
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
            'parent',
            'child',
        ],
    ]);
    ?>
</div>