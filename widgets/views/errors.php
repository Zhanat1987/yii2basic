<div class="modal fade errorsM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <?php echo Yii::t('common', 'Внимание'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <?php foreach ($errors as $error) : ?>
                    <p>
                        <?php echo $error; ?>
                    </p>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <?php echo Yii::t('common', 'Закрыть'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
$this->registerJs("$('.errorsM').modal();");
?>