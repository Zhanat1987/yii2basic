<?php

use app\assets\CloudAsset;
use yii\helpers\Html;
use app\widgets\Header;
use app\widgets\Sidebar;
use app\widgets\BreadCrumbs;
use app\assets\DatePickerAsset;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
CloudAsset::register($this);
DatePickerAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language; ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="<?php echo Yii::$app->charset; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,
        maximum-scale=1, user-scalable=no">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/js/flot/excanvas.min.js"></script>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/myfiles/js/html5.js"></script>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/myfiles/js/css3-mediaqueries.js"></script>
    <![endif]-->
    <title>
        <?php echo Html::encode($this->title); ?>
    </title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php echo Header::widget(); ?>
<!-- PAGE -->
<section id="page">
    <?php echo Sidebar::widget(); ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div id="content" class="col-lg-12">
                    <!-- PAGE HEADER-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-header">
                                <?php echo BreadCrumbs::widget(); ?>
                                <div class="clearfix">
                                    <h3 class="content-title pull-left">
                                        <?php echo Html::encode($this->title); ?>
                                    </h3>
                                </div>
                                <div class="description">
                                    <?php echo $content; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /PAGE HEADER -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/PAGE -->
<div class="modal-loading-bg"></div>
<div class="modal-loading"></div>
<div class="requestUrl">
    <?php echo Yii::$app->request->url; ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>