<?php
use app\assets\ErrorAsset;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
ErrorAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/js/flot/excanvas.min.js"></script>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/myfiles/js/html5.js"></script>
    <script src="<?php echo Yii::getAlias('@cloud'); ?>/myfiles/js/css3-mediaqueries.js"></script>
    <![endif]-->
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
</head>
<body class="login">
<?php $this->beginBody() ?>
    <?php
    /**
     * @var yii\web\View $this
     * @var string $name
     * @var string $message
     * @var Exception $exception
     * отключить макет
     */
    $this->context->layout = false;
    $errorClass = strpos($exception->statusCode, '4') === 0 ? 'error' : 'error-500';
    ?>
    <!-- PAGE -->
    <section id="page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="divide-100"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 not-found text-center">
                    <div class="<?php echo $errorClass; ?>">
                        <?php echo Html::encode($exception->statusCode); ?>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4 not-found text-center">
                    <div class="content">
                        <h3>
                            <?php echo Html::encode($message); ?>
                        </h3>
                        <?php if ($exception->statusCode == 404) : ?>
                            <p>
                                Извините, но страница, которую вы ищите не найдена.<br />
                                Попробуйте проверить URL на ошибки,
                                <a href="/">
                                    вернуться на главную
                                </a>
                                или воспользуйтесь поиском ниже.
                            </p>
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="искать...">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        <?php else : ?>
                            <p>
                                Упс! Что-то пошло не так. Не беспокойтесь! Мы работаем над этим.
                            </p>
                            <div class="btn-group">
                                <a href="<?php echo \Yii::$app->request->referrer; ?>" class="btn btn-danger">
                                    <i class="fa fa-chevron-left"></i>
                                    Вернуться назад
                                </a>
                                <a href="/"
                                    class="btn btn-default">
                                    Главная страница
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/PAGE -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>