<?php
use app\assets\RecipientColumnsAsset;
RecipientColumnsAsset::register($this);
$this->registerJs($js);
?>
<button type="button" class="pull-right mr-20 btn btn-primary columns" grid="<?php echo $grid; ?>">
    <?php echo Yii::t('common', 'Колонки'); ?>
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
                <label for="c1">
                    <input type="checkbox" value="1" id="c1" name="c1">
                    <?php echo Yii::t('common', 'Код записи'); ?>
                </label>
                <label for="c2">
                    <input type="checkbox" value="2" id="c2" name="c2">
                    <?php echo Yii::t('common', 'Дата создания'); ?>
                </label>
                <label for="c3">
                    <input type="checkbox" value="3" id="c3" name="c3">
                    <?php echo Yii::t('common', 'Имя'); ?>
                </label>
                <label for="c4">
                    <input type="checkbox" value="4" id="c4" name="c4">
                    <?php echo Yii::t('common', 'Фамилия'); ?>
                </label>
                <label for="c5">
                    <input type="checkbox" value="5" id="c5" name="c5">
                    <?php echo Yii::t('common', 'Отчество'); ?>
                </label>
                <label for="c6">
                    <input type="checkbox" value="6" id="c6" name="c6">
                    <?php echo Yii::t('common', 'Дата рождения'); ?>
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <?php echo Yii::t('common', 'Сохранить'); ?>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <?php echo Yii::t('common', 'Отменить'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->