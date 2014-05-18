<?php
use app\assets\LoginAsset;
LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1,
    user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/js/flot/excanvas.min.js"></script>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/myfiles/js/html5.js"></script>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/myfiles/js/css3-mediaqueries.js"></script>
    <![endif]-->
    <title>
        <?php echo $this->title; ?>
    </title>
    <?php $this->head() ?>
</head>
<body class="login">
<?php $this->beginBody() ?>
<div class="wrap">
    <!-- PAGE -->
    <section id="page">
        <?php echo $content; ?>
    </section>
    <!--/PAGE -->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>