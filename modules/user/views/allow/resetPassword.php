<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- RESET PASSWORD -->
<section id="reset-password" class="visible">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-box-plain">
                    <h2 class="bigintro">
                        <?= Html::encode($this->title) ?>
                    </h2>
                    <div class="divide-40"></div>
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                    <?php echo $form->field($model, 'password')->passwordInput(
                        ['placeholder' => 'Новый пароль']
                    ); ?>
                    <div class="form-actions">
                        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/RESET PASSWORD -->
