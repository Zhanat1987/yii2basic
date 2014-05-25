<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\request\models\Header $model
 */

$this->title = Yii::t('request', 'Update {modelClass}: ', [
    'modelClass' => 'Header',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('request', 'Headers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('request', 'Update');
?>
<div class="header-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
