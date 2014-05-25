<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\request\models\Header $model
 */

$this->title = Yii::t('request', 'Create {modelClass}', [
    'modelClass' => 'Header',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('request', 'Headers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
