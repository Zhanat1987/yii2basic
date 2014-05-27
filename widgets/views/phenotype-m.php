<div class="modal fade phenotypeM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <?php echo Yii::t('common', 'Фенотип'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td rowspan="2">
                            <div class="checkbox_img checkbox_2 c" v="CC">CC</div>
                            <div class="checkbox_img checkbox_2 c" v="Cc">Cc</div>
                            <div class="checkbox_img checkbox_2 c" v="cc">cc</div>
                            <div class="checkbox_img checkbox_2 c" v="CwC">CwC</div>
                            <div class="checkbox_img checkbox_2 c" v="Cwc">Cwc</div>
                            <div class="checkbox_img checkbox_2 c" v="CwCw">CwCw</div>
                            <div class="checkbox_img checkbox_2 c" v="CcCw">CcCw</div>
                        </td>
                        <td>
                            <div class="checkbox_img checkbox_2 d" v="D">D</div>
                            <div class="checkbox_img checkbox_2 d" v="dd">dd</div>
                            <div class="checkbox_img checkbox_2 d" v="Du">Du</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox_img checkbox_2 e" v="EE">EE</div>
                            <div class="checkbox_img checkbox_2 e" v="Ee">Ee</div>
                            <div class="checkbox_img checkbox_2 e" v="ee">ee</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <?php echo Yii::t('common', 'Сохранить'); ?>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <?php echo Yii::t('common', 'Отмена'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->