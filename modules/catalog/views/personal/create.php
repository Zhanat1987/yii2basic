<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Personal $model
 */
$this->title = Yii::t('personal', 'Создать персонал');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Персонал'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-create">
    <?= $this->render('_form', [
        'model' => $model,
        'organizations' => $organizations,
        'departments' => $departments,
    ]) ?>
</div>