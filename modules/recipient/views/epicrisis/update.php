<?php
$this->title = Yii::t('recipient', 'Эпикризис');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Реципиенты'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="info-update">
    <?= $this->render('_form', [
        'post' => $post,
        'pre' => $pre,
    ]) ?>
</div>