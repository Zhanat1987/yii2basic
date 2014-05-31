<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\PRE $model
 */

$this->title = Yii::t('recipient', 'Update {modelClass}: ', [
    'modelClass' => 'Pre',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Pres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('recipient', 'Update');
?>
<div class="pre-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
