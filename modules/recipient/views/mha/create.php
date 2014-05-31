<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\MHA $model
 */

$this->title = Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Mha',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Mhas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mha-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
