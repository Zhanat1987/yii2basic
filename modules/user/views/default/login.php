<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Авторизация';
?>
<!-- LOGIN -->
<section id="login" class="visible">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-box-plain">
                    <h2 class="bigintro">
                        Авторизация
                    </h2>
                    <div class="divide-40"></div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?php echo $form->field($model, 'username'); ?>
                        <?php echo $form->field($model, 'password')->passwordInput(); ?>
                        <div class="form-actions">
                            <?php echo $form->field($model, 'rememberMe')->checkbox(); ?>
                            <?php echo Html::submitButton('Войти',
                                ['class' => 'btn btn-danger', 'name' => 'login-button']); ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <!-- SOCIAL LOGIN -->
                    <div class="divide-20"></div>
                    <div class="center">
                        <strong>
                            Или авторизуйтесь, используя социальный аккаунт
                        </strong>
                    </div>
                    <div class="divide-20"></div>
                    <div class="social-login center">
                        <a class="btn btn-primary btn-lg">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a class="btn btn-info btn-lg">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a class="btn btn-danger btn-lg">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                    <!-- /SOCIAL LOGIN -->
                    <div class="login-helpers">
                        <a href="#" onclick="swapScreen('forgot');return false;">
                            Забыли пароль?
                        </a><br>
                        Нет аккаунта?&nbsp;
                        <a href="#" onclick="swapScreen('register');return false;">
                            Зарегистрируйтесь сейчас!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/LOGIN -->
<!-- REGISTER -->
<section id="register">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-box-plain">
                    <h2 class="bigintro">
                        Регистрация
                    </h2>
                    <div class="divide-40"></div>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?php echo $form->field($modelSF, 'username') ?>
                        <?php echo $form->field($modelSF, 'email') ?>
                        <?php echo $form->field($modelSF, 'password')->passwordInput() ?>
                        <div class="form-actions">
                            <?php echo Html::submitButton('Регистрация', ['class' => 'btn btn-primary',
                                'name' => 'signup-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <!-- SOCIAL REGISTER -->
                    <div class="divide-20"></div>
                    <div class="center">
                        <strong>
                            Или зарегистрируйтесь, используя Ваш социальный аккаунт
                        </strong>
                    </div>
                    <div class="divide-20"></div>
                    <div class="social-login center">
                        <a class="btn btn-primary btn-lg">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a class="btn btn-info btn-lg">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a class="btn btn-danger btn-lg">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                    <!-- /SOCIAL REGISTER -->
                    <div class="login-helpers">
                        <a href="#" onclick="swapScreen('login');return false;">
                            Вернуться в авторизацию
                        </a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/REGISTER -->
<!-- FORGOT PASSWORD -->
<section id="forgot">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-box-plain">
                    <h2 class="bigintro">
                        Восстановите пароль
                    </h2>
                    <div class="divide-40"></div>
                    <?php if (Yii::$app->getSession()->hasFlash('successPRRF') ||
                        Yii::$app->getSession()->hasFlash('errorPRRF')) : ?>
                        <?php if (Yii::$app->getSession()->hasFlash('successPRRF')) : ?>
                            <div class="alert alert-block alert-success fade in">
                                <a aria-hidden="true" href="#" data-dismiss="alert" class="close">×</a>
                                <p></p>
                                <h4><i class="fa fa-heart"></i> Пароль успешно восстановлен!</h4>
                                <p>
                                    <?php echo Yii::$app->getSession()->getFlash('successPRRF'); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->getSession()->hasFlash('errorPRRF')) : ?>
                            <div class="alert alert-block alert-danger fade in">
                                <a aria-hidden="true" href="#" data-dismiss="alert" class="close">×</a>
                                <h4>
                                    <i class="fa fa-times"></i>
                                    &nbsp;Произошла ошибка!
                                </h4>
                                <p>
                                    <?php echo Yii::$app->getSession()->getFlash('errorPRRF'); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                        <?php echo $form->field($modelPRRF, 'email')->label('Укажите Ваш Email адрес'); ?>
                        <div class="form-actions">
                            <?php echo Html::submitButton('Выслать мне инструкции',
                                ['class' => 'btn btn-info', 'name' => 'prrf-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <div class="login-helpers">
                        <a href="#" onclick="swapScreen('login');return false;">
                            Вернуться в авторизацию
                        </a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FORGOT PASSWORD -->