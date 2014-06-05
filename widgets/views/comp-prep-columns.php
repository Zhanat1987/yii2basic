<?php
use app\assets\CompPrepColumnsAsset;
CompPrepColumnsAsset::register($this);
$this->registerJs($js);
?>
<button sub="kk" type="button" class="pull-right mr-20 btn btn-primary columns">
    <?php echo Yii::t('common', 'Колонки для КК'); ?>
</button>
<div class="modal fade columnsM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="columnsMKK">
                    <label for="c1">
                        <input type="checkbox" value="1" id="c1" name="c1">
                        <?php echo Yii::t('common', 'Код записи'); ?>
                    </label>
                    <label for="c2">
                        <input type="checkbox" value="2" id="c2" name="c2">
                        <?php echo Yii::t('common', 'Дата регистрации'); ?>
                    </label>
                    <label for="c3">
                        <input type="checkbox" value="3" id="c3" name="c3">
                        <?php echo Yii::t('common', 'Наименование'); ?>
                    </label>
                    <label for="c4">
                        <input type="checkbox" value="4" id="c4" name="c4">
                        <?php echo Yii::t('common', 'Группа крови'); ?>
                    </label>
                    <label for="c5">
                        <input type="checkbox" value="5" id="c5" name="c5">
                        <?php echo Yii::t('common', 'Объём'); ?>
                    </label>
                    <label for="c6">
                        <input type="checkbox" value="6" id="c6" name="c6">
                        <?php echo Yii::t('common', 'Регистрационный №'); ?>
                    </label>
                    <label for="c7">
                        <input type="checkbox" value="7" id="c7" name="c7">
                        <?php echo Yii::t('common', 'Дата заготовки'); ?>
                    </label>
                    <label for="c8">
                        <input type="checkbox" value="8" id="c8" name="c8">
                        <?php echo Yii::t('common', 'Срок годности'); ?>
                    </label>
                    <label for="c9" class="bs">
                        <input type="checkbox" value="9" id="c9" name="c9">
                        <?php echo Yii::t('common', 'Отправлен'); ?>
                    </label>
                    <label for="c10">
                        <input type="checkbox" value="10" id="c10" name="c10">
                        <?php echo Yii::t('common', 'Дата отправки'); ?>
                    </label>
                    <label for="c11">
                        <input type="checkbox" value="11" id="c11" name="c11">
                        <?php echo Yii::t('common', 'Отделение'); ?>
                    </label>
                    <label for="c12">
                        <input type="checkbox" value="12" id="c12" name="c12">
                        <?php echo Yii::t('common', 'Номер накладной или акта'); ?>
                    </label>
                    <label for="c13">
                        <input type="checkbox" value="13" id="c13" name="c13">
                        <?php echo Yii::t('common', '№ истории болезни'); ?>
                    </label>
                    <label for="c14">
                        <input type="checkbox" value="14" id="c14" name="c14">
                        <?php echo Yii::t('common', 'Донор'); ?>
                    </label>
                    <label for="c15" class="bs">
                        <input type="checkbox" value="15" id="c15" name="c15">
                        <?php echo Yii::t('common', 'ФИО реципиента'); ?>
                    </label>
                </div>
                <div class="columnsMPK">
                    <label for="c16">
                        <input type="checkbox" value="16" id="c16" name="c16">
                        <?php echo Yii::t('common', 'Код записи'); ?>
                    </label>
                    <label for="c17">
                        <input type="checkbox" value="17" id="c17" name="c17">
                        <?php echo Yii::t('common', 'Дата регистрации'); ?>
                    </label>
                    <label for="c18">
                        <input type="checkbox" value="18" id="c18" name="c18">
                        <?php echo Yii::t('common', 'Наименование'); ?>
                    </label>
                    <label for="c19">
                        <input type="checkbox" value="19" id="c19" name="c19">
                        <?php echo Yii::t('common', 'Группа крови'); ?>
                    </label>
                    <label for="c20">
                        <input type="checkbox" value="20" id="c20" name="c20">
                        <?php echo Yii::t('common', 'Объём'); ?>
                    </label>
                    <label for="c21">
                        <input type="checkbox" value="21" id="c21" name="c21">
                        <?php echo Yii::t('common', 'Серия'); ?>
                    </label>
                    <label for="c22">
                        <input type="checkbox" value="22" id="c22" name="c22">
                        <?php echo Yii::t('common', 'Дата заготовки'); ?>
                    </label>
                    <label for="c23">
                        <input type="checkbox" value="23" id="c23" name="c23">
                        <?php echo Yii::t('common', 'Срок годности'); ?>
                    </label>
                    <label for="c24" class="bs">
                        <input type="checkbox" value="24" id="c24" name="c24">
                        <?php echo Yii::t('common', 'Отправлен'); ?>
                    </label>
                    <label for="c25">
                        <input type="checkbox" value="25" id="c25" name="c25">
                        <?php echo Yii::t('common', 'Дата отправки'); ?>
                    </label>
                    <label for="c26">
                        <input type="checkbox" value="26" id="c26" name="c26">
                        <?php echo Yii::t('common', 'Отделение'); ?>
                    </label>
                    <label for="c27">
                        <input type="checkbox" value="27" id="c27" name="c27">
                        <?php echo Yii::t('common', 'Номер накладной или акта'); ?>
                    </label>
                    <label for="c28">
                        <input type="checkbox" value="28" id="c28" name="c28">
                        <?php echo Yii::t('common', '№ истории болезни'); ?>
                    </label>
                    <label for="c29" class="bs">
                        <input type="checkbox" value="29" id="c29" name="c29">
                        <?php echo Yii::t('common', 'ФИО реципиента'); ?>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <?php echo \Yii::t('common', 'Сохранить'); ?>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <?php echo \Yii::t('common', 'Отменить'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->