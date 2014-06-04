<?php
$this->title = Yii::t('recipient', 'Создание эпикризиса');
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Реципиенты'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="info-update">
    <?= $this->render('_form', [
        'pre' => $pre,
        'indicationsTransfusion' => $indicationsTransfusion,
        'personal' => $personal,
        'post' => $post,
        'errors' => $errors,
    ]) ?>
</div>