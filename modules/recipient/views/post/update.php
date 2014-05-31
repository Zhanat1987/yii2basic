<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\POST $model
 */

$this->title = Yii::t('recipient', 'Update {modelClass}: ', [
    'modelClass' => 'Post',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('recipient', 'Update');
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
