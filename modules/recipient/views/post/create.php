<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\POST $model
 */

$this->title = Yii::t('recipient', 'Create {modelClass}', [
    'modelClass' => 'Post',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('recipient', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
