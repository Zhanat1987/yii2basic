<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\PRE $model
 */

$this->title = Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Pre',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Pres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pre-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
