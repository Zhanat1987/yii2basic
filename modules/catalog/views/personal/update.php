<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Personal $model
 */
$this->title = Yii::t('personal', 'Редактировать персонал: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Персонал'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="personal-update">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
        'departments' => $departments,
    ]) ?>
</div>