<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\catalog\models\Catalog $model
 */

$this->title = Yii::t('catalog', 'Create {modelClass}', [
  'modelClass' => 'Catalog',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
