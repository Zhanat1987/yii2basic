<?php
/**
 * @var yii\web\View $this
 * @var app\modules\request\models\Header $model
 */
$this->title = Yii::t('request', 'Заявка № ') . $model->id;
$this->params['breadcrumbs'][] = Yii::t('common', 'Стационар');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = Yii::t('common', 'Редактирование');
//Yii::$app->debugger->debug($model->getErrors());
?>
<div class="header-update">
    <?= $this->render('_form', [
        'model' => $model,
        'statuses' => $statuses,
        'urgency' => $urgency,
        'types' => $types,
        'organizations' => $organizations,
        'targets' => $targets,
        'personal' => $personal,
        'targetTitle' => $targetTitle,
        'targetTitleCreate' => $targetTitleCreate,
    ]) ?>
</div>