<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\myhelpers\Current;

/**
 * @var yii\web\View $this
 * @var app\modules\user\models\User $model
 */

if ($model->id == Yii::$app->session->get('userId')) {
    $label = Yii::t('common', 'Редактировать профиль');
    $url = ['profile-edit'];
    $this->title = Yii::t('common', 'Профиль');
} else {
    $label = Yii::t('common', 'Редактировать');
    $url = ['update', 'id' => $model->id];
    $this->title = $model->id;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Пользователи'), 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <p>
        <?php echo Html::a($label, $url, ['class' => 'btn btn-primary']); ?>
        <?php
        if (Yii::$app->session->get('role') == 'супер-администратор') {
            echo Html::a(Yii::t('common', 'Удалить'),
                ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('common', 'Вы уверены, что хотите удалить эту запись?'),
                        'method' => 'post',
                    ],
                ]);
        }
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