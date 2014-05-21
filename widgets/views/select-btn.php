<?php
if ($modal == 'catalog') {
    app\assets\CatalogModalAsset::register($this);
}
?>
<div class="form-group field-<?php echo $id; ?>">
    <label for="<?php echo $id; ?>" class="control-label">
        <?php echo $label; ?>
    </label>
    <p class="input-group">
        <select name="<?php echo $name; ?>" id="<?php echo $id; ?>"<?php echo $options; ?>>
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
        <span class="input-group-btn" id="<?php echo $entity; ?>">
            <a class="btn btn-default" id="mL<?php echo $id; ?>" href="#">
                <i class="fa fa-list-ul"></i>
            </a>
        </span>
    </p>
    <div class="help-block"></div>
</div>
<div class="modal fade <?php echo $entity; ?>M">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <?php echo $title; ?>
                </h4>
            </div>
            <div class="modal-body"></div>
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