<?php
use yii\helpers\Html;
use app\widgets\Phenotype;
use app\widgets\PhenotypeM;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box-container">
            <div class="box border rbkdiv">
                <div class="box-title">
                    <h4>
                        <?php echo Yii::t('common', 'Компоненты'); ?>
                    </h4>
                </div>
                <div class="box-body">
                    <table id="table-tab-kk" class="table table-bordered table-infoblood">
                        <tr>
                            <th class="width-50">
                                <label>
                                    <?php echo Yii::t('common', 'Действие') ?>
                                </label>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['registration_number']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-300">
                                <label>
                                    <?php echo Yii::t('common', 'Компонент'); ?>
                                    <span class="required">*</span>
                                </label>
                            </th>
                            <th class="width-150">
                                <?php echo $labels['blood_group']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-150">
                                <?php echo $labels['rh_factor']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-150">
                                <?php echo $labels['phenotype']; ?>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['volume']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['date_prepare']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['date_expiration']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['donor']; ?>
                            </th>
                        </tr>
                        <?php foreach ($modelsKK as $k => $modelKK) : ?>
                            <tr<?php echo ($k == 0) ? ' class="rbkTr"' : ''; ?> id="<?php echo $modelKK->id; ?>">
                                <td class="text-center">
                                    <?php
                                    echo Html::activeHiddenInput($modelKK, 'type', [
                                        'name' => "Body[type][]"
                                    ]);
                                    echo Html::activeHiddenInput($modelKK, 'id', [
                                        'name' => "Body[id][]"
                                    ]);
                                    echo Html::activeHiddenInput($modelKK, 'oldQuantity', [
                                        'name' => "Body[oldQuantity][]"
                                    ]);
                                    ?>
                                    <?php if (!$modelKK->is_moved) : ?>
                                        <span id="<?php echo $modelKK->id; ?>"
                                              class="rbDelete <?php echo ($k == 1) ?
                                                  'rbpTrReplace' : 'rbRemove'; ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelKK, 'registration_number', [
                                        'name' => "Body[registration_number][]",
                                        'class' => 'form-control width-100 kkRn',
                                        'onkeyup' => 'onlyDigits(this)',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeDropDownList($modelKK, 'comp_prep_id', $kks, [
                                        'name' => "Body[comp_prep_id][]",
                                        'class' => 'width100 component_id' . ($k == 0 ? '' : ' select2'),
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeDropDownList($modelKK, 'blood_group', $bloodGroups, [
                                        'name' => "Body[blood_group][]",
                                        'class' => 'width100 blood_group' . ($k == 0 ? '' : ' select2'),
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeDropDownList($modelKK, 'rh_factor', $rhFactors, [
                                        'name' => "Body[rh_factor][]",
                                        'class' => 'width100 rh_factor' . ($k == 0 ? '' : ' select2'),
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Phenotype::widget([
                                        'name' => "Body[phenotype][]",
                                        'value' => $modelKK->phenotype,
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelKK, 'volume', [
                                        'name' => "Body[volume][]",
                                        'class' => 'form-control width-100 volume',
                                        'onkeyup' => 'onlyDigits(this)',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelKK, 'date_prepare', [
                                        'name' => "Body[date_prepare][]",
                                        'class' => 'form-control width-100 tbDatePicker date_prepare',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelKK, 'date_expiration', [
                                        'name' => "Body[date_expiration][]",
                                        'class' => 'form-control width-100 tbDatePicker date_expiration',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelKK, 'donor', [
                                        'name' => "Body[donor][]",
                                        'class' => 'form-control width-100 donor',
                                    ]);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo PhenotypeM::widget(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box-container">
            <div class="box border rbkdiv">
                <div class="box-title">
                    <h4>
                        <?php echo Yii::t('common', 'Препараты'); ?>
                    </h4>
                </div>
                <div class="box-body">
                    <table id="table-tab-pk" class="table table-bordered table-infoblood">
                        <tr>
                            <th class="width-50">
                                <label>
                                    <?php echo Yii::t('common', 'Действие') ?>
                                </label>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['series']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-300">
                                <label>
                                    <?php echo Yii::t('common', 'Препарат'); ?>
                                    <span class="required">*</span>
                                </label>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['volume']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['date_prepare']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['date_expiration']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['quantity']; ?>
                                <span class="required">*</span>
                            </th>
                        </tr>
                        <?php foreach ($modelsPK as $k => $modelPK) : ?>
                            <tr<?php echo ($k == 0) ? ' class="rbpTr"' : ''; ?> id="<?php echo $modelPK->id; ?>">
                                <td class="text-center">
                                    <?php
                                    echo Html::activeHiddenInput($modelPK, 'type', [
                                        'name' => "Body[type][]"
                                    ]);
                                    echo Html::activeHiddenInput($modelPK, 'id', [
                                        'name' => "Body[id][]"
                                    ]);
                                    echo Html::activeHiddenInput($modelPK, 'oldQuantity', [
                                        'name' => "Body[oldQuantity][]"
                                    ]);
                                    ?>
                                    <?php if (!$modelPK->is_moved) : ?>
                                        <span id="<?php echo $modelPK->id; ?>"
                                            class="rbDelete <?php echo ($k == 1) ?
                                                'rbpTrReplace' : 'rbRemove'; ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelPK, 'series', [
                                        'name' => "Body[series][]",
                                        'class' => 'form-control width-100',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeDropDownList($modelPK, 'comp_prep_id', $pks, [
                                        'name' => "Body[comp_prep_id][]",
                                        'class' => $k == 0 ? 'width100' : 'select2 width100'
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelPK, 'volume', [
                                        'name' => "Body[volume][]",
                                        'class' => 'form-control width-100',
                                        'onkeyup' => 'onlyDigits(this)',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelPK, 'date_prepare', [
                                        'name' => "Body[date_prepare][]",
                                        'class' => 'form-control width-100 tbDatePicker',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelPK, 'date_expiration', [
                                        'name' => "Body[date_expiration][]",
                                        'class' => 'form-control width-100 tbDatePicker',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelPK, 'quantity', [
                                        'name' => "Body[quantity][]",
                                        'class' => 'form-control width-100',
                                        'onkeyup' => 'notMore(this)',
                                        'max' => 999,
                                    ]);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>