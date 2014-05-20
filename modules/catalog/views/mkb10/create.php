<?php
/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Mkb10 $model
 */
$this->title = Yii::t('mkb10', 'Создание МКБ 10');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'МКБ 10'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkb10-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>