<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MH $model
 */

$this->title = Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Mh',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Mhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
