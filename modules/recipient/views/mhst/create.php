<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MHST $model
 */

$this->title = Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Mhst',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Mhsts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhst-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
