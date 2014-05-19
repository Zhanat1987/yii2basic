<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 */

$this->title = Yii::t('organization', 'Update {modelClass}: ', [
  'modelClass' => 'Organization',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('organization', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('organization', 'Update');
?>
<div class="organization-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
