<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MH $model
 */

$this->title = Yii::t('recipient', 'Update {modelClass}: ', [
    'modelClass' => 'Mh',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Mhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('recipient', 'Update');
?>
<div class="mh-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
