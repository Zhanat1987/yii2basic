<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */

$this->title = Yii::t('catalog', 'Update {modelClass}: ', [
  'modelClass' => 'Catalog',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('catalog', 'Update');
?>
<div class="catalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
