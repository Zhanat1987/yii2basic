<div class="form-group field-header-request">
    <label for="header-request" class="control-label">
        <?php echo $label; ?>
    </label>
    <p class="input-group">
        <input type="text" name="Header[request]"
               class="form-control" readonly="readonly"
               id="header-request" value="<?php echo $value; ?>" />
        <span class="input-group-btn requestSpan">
            <a class="btn btn-default" href="#">
                <i class="fa fa-list-ul"></i>
            </a>
        </span>
    </p>
    <div class="help-block"></div>
    <div class="requestInfo"></div>
</div>
<div class="modal fade requestM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <?php echo $label; ?>
                </h4>
            </div>
            <div class="modal-body"></div>
            <div class="requestResponse"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <?php echo \Yii::t('common', 'Выбрать'); ?>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <?php echo \Yii::t('common', 'Отменить'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->