<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = Yii::t('common', 'Авторизация');
?>
<!-- LOGIN -->
<section id="login" class="visible">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-box-plain">
                    <h2 class="bigintro">
                        <?php echo Yii::t('common', 'Авторизация'); ?>
                    </h2>
                    <div class="divide-40"></div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?php echo $form->field($model, 'username'); ?>
                        <?php echo $form->field($model, 'password')->passwordInput(); ?>
                        <div class="form-actions">
                            <?php echo $form->field($model, 'rememberMe')->checkbox(); ?>
                            <?php echo Html::submitButton(Yii::t('common', 'Войти'),
                                ['class' => 'btn btn-danger', 'name' => 'login-button']); ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <div class="login-helpers">
                        <a href="#" onclick="swapScreen('forgot');return false;">
                            <?php echo Yii::t('common', 'Забыли пароль?'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/LOGIN -->
<!-- FORGOT PASSWORD -->
<section id="forgot">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-box-plain">
                    <h2 class="bigintro">
                        <?php echo Yii::t('common', 'Восстановите пароль'); ?>
                    </h2>
                    <div class="divide-40"></div>
                    <?php if (Yii::$app->getSession()->hasFlash('successPRRF') ||
                        Yii::$app->getSession()->hasFlash('errorPRRF')) : ?>
                        <?php if (Yii::$app->getSession()->hasFlash('successPRRF')) : ?>
                            <div class="alert alert-block alert-success fade in">
                                <a aria-hidden="true" href="#" data-dismiss="alert" class="close">
                                    ×
                                </a>
                                <p></p>
                                <h4>
                                    <i class="fa fa-envelope"></i>
                                    <?php echo Yii::t('common', 'Пароль успешно восстановлен!'); ?>
                                </h4>
                                <p>
                                    <?php echo Yii::$app->getSession()->getFlash('successPRRF'); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->getSession()->hasFlash('errorPRRF')) : ?>
                            <div class="alert alert-block alert-danger fade in">
                                <a aria-hidden="true" href="#" data-dismiss="alert" class="close">
                                    ×
                                </a>
                                <h4>
                                    <i class="fa fa-exclamation"></i>
                                    <?php echo Yii::t('common', 'Произошла ошибка!'); ?>
                                </h4>
                                <p>
                                    <?php echo Yii::$app->getSession()->getFlash('errorPRRF'); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                        <?php
                        echo $form->field($modelPRRF, 'email')
                            ->label(Yii::t('common', 'Укажите Ваш Email адрес'));
                        ?>
                        <div class="form-actions">
                            <?php
                            echo Html::submitButton(
                                Yii::t('common', 'Выслать мне инструкции'),
                                ['class' => 'btn btn-info', 'name' => 'prrf-button']);
                            ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <div class="login-helpers">
                        <a href="#" onclick="swapScreen('login');return false;">
                            <?php echo Yii::t('common', 'Вернуться в авторизацию'); ?>
                        </a><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FORGOT PASSWORD -->