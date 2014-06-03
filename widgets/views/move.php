<?php
\app\assets\MoveAsset::register($this);
?>
<div class="modal fade moveM">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    <?php echo Yii::t('bloodstorage', 'Перемещение'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-4">
                    <input type="text" class="form-control tbDatePicker width-230"
                           value="<?php echo Yii::$app->current->getDate(); ?>" id="mDate" />
                    <input value="" class="id" type="hidden" />
                </div>
                <div class="col-md-4">
                    <select class="type width-230">
                        <?php foreach ($typesSend as $k => $v) : ?>
                            <?php if (in_array($k, [1, 2, 3, 4])) : ?>
                                <option value="<?php echo $k; ?>">
                                    <?php echo $v; ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="department width-230">
                        <?php if ($departments) : ?>
                            <?php foreach ($departments as $k => $v) : ?>
                                <option value="<?php echo $k; ?>">
                                    <?php echo $v; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">
                                <?php echo Yii::t('common', 'Нет данных'); ?>
                            </option>
                        <?php endif; ?>
                    </select>
                    <select class="defect width-230">
                        <?php if ($defects) : ?>
                            <?php foreach ($defects as $k => $v) : ?>
                                <option value="<?php echo $k; ?>">
                                    <?php echo $v; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">
                                <?php echo Yii::t('bloodstorage', 'Нет данных'); ?>
                            </option>
                        <?php endif; ?>
                    </select>
                    <select class="organization width-230">
                        <?php if ($organizations) : ?>
                            <?php foreach ($organizations as $k => $v) : ?>
                                <option value="<?php echo $k; ?>">
                                    <?php echo $v; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">
                                <?php echo Yii::t('bloodstorage', 'Нет данных'); ?>
                            </option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="divide-40"></div>
                <div class="row countDiv">
                    <input class="form-control width-80 count" value="1" max="" type="text" onkeyup="notMore(this);">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <?php echo Yii::t('bloodstorage', 'Переместить'); ?>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <?php echo Yii::t('bloodstorage', 'Отменить'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->