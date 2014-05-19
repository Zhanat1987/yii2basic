<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\organization\models\Organization $model
 */

$this->title = Yii::t('organization', 'Create {modelClass}', [
  'modelClass' => 'Organization',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('organization', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
