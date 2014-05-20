<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Mkb10 $model
 */
$this->title = Yii::t('mkb10', 'Редактирование МКБ 10: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'МКБ 10'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="mkb10-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>