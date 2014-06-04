<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\widgets\CancelBtn;
use app\assets\EpicrisisAsset;

/**
 * @var yii\web\View $this
 * @var app\modules\recipient\models\Info $model
 * @var yii\widgets\ActiveForm $form
 */
Select2Asset::register($this);
EpicrisisAsset::register($this);

if ($errors) {
    echo \app\widgets\Errors::widget(['errors' => $errors]);
}
?>
<div class="info-form">
    <?php $form = ActiveForm::begin([
        'validateOnChange' => false,
        'validateOnSubmit' => false,
        'options' => [
            'id' => 'epicrisis-form',
        ]
    ]); ?>
    <div class="col-md-12">
        <div class="box border">
            <div class="box-title">
                <h4>
                    <?php echo Yii::t('recipient', 'Анкета реципиента'); ?>
                </h4>
            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">
                        <li>
                            <a data-toggle="tab" href="#box_tab3">
                                <i class="fa fa-desktop"></i>
                            <span class="hidden-inline-mobile">
                                <?php echo Yii::t('recipient', 'Используемые КК/ПК'); ?>
                            </span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#box_tab2">
                                <i class="fa fa-flask"></i>
                            <span class="hidden-inline-mobile">
                                <?php echo Yii::t('recipient', 'Посттрансфузионный эпикриз'); ?>
                            </span>
                            </a>
                        </li>
                        <li class="active">
                            <a data-toggle="tab" href="#box_tab1">
                                <i class="fa fa-home"></i>
                            <span class="hidden-inline-mobile">
                                <?php echo Yii::t('recipient', 'Предтрансфузионный эпикриз'); ?>
                            </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="box_tab1" class="tab-pane fade active in">
                            <?php
                            echo $this->render('post', [
                                'form' => $form,
                                'model' => $post,
                            ]);
                            ?>
                        </div>
                        <div id="box_tab2" class="tab-pane fade">
                            <?php
                            echo $this->render('pre', [
                                'form' => $form,
                                'model' => $pre,
                            ]);
                            ?>
                        </div>
                        <div id="box_tab3" class="tab-pane fade">
                            box_tab3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo Html::submitButton($post->isNewRecord ?
                Yii::t('common', 'Создать') : Yii::t('common', 'Редактировать'),
            ['class' => $post->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        if (Yii::$app->controller->action->id != 'view') {
            echo CancelBtn::widget(
                [
                    'url' => '/recipient/info/index',
                ]
            );
        }
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>