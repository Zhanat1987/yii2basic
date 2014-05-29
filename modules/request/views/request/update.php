<?php
/**
 * @var yii\web\View $this
 * @var app\modules\request\models\Header $model
 */
$this->title = Yii::t('request', 'Заявка № ') . $model->id;
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('request', 'Заявки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
?>
<div class="header-update">
    <?= $this->render('_form', [
        'model' => $model,
        'urgency' => $urgency,
        'types' => $types,
        'organizations' => $organizations,
        'targets' => $targets,
        'personal' => $personal,
        'targetTitle' => $targetTitle,
        'targetTitleCreate' => $targetTitleCreate,
        'modelsKK' => $modelsKK,
        'modelsPK' => $modelsPK,
        'kks' => $kks,
        'pks' => $pks,
        'bloodGroups' => $bloodGroups,
        'rhFactors' => $rhFactors,
        'labels' => $labels,
        'errors' => $errors,
    ]) ?>
</div>