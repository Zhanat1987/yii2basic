<?php app\assets\mkb10Asset::register($this); ?>
<div class="form-group field-<?php echo $id; ?>">
    <label for="<?php echo $id; ?>" class="control-label">
        <?php echo $label; ?>
    </label>
    <p class="input-group">
        <select name="<?php echo $name; ?>"
                id="<?php echo $id; ?>"
                class="select2 width100">
            <?php foreach ($data as $k => $v) : ?>
                <?php if ($value == $k) : ?>
                    <option value="<?php echo $k; ?>" selected="selected">
                <?php else : ?>
                    <option value="<?php echo $k; ?>">
                <?php endif; ?>
                    <?php echo $v; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="input-group-btn mkb10Span">
            <a class="btn btn-default" href="#">
                <i class="fa fa-list-ul"></i>
            </a>
        </span>
    </p>
    <div class="help-block"></div>
</div>
<div class="modal fade mkb10SpanM" id="<?php echo $id; ?>">
    <div class="modal-dialog"
        <?php if ($width) : ?>
            style="width: <?php echo $width; ?>"
        <?php endif; ?>>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <?php echo \Yii::t('common', 'Код диагноза по МКБ'); ?>
                </h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mkb10Primary">
                    <?php echo \Yii::t('common', 'Сохранить'); ?>
                </button>
                <button type="button" class="btn btn-danger mkb10Danger" data-dismiss="modal">
                    <?php echo \Yii::t('common', 'Отменить'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->