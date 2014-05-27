<?php
use yii\helpers\Html;
use app\widgets\Phenotype;
use app\widgets\PhenotypeM;
use app\assets\RequestAsset;

RequestAsset::register($this);
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
                                <?php echo $labels['quantity']; ?>
                                <span class="required">*</span>
                            </th>
                        </tr>
                        <?php foreach ($modelsKK as $k => $modelKK) : ?>
                            <tr<?php echo ($k == 0) ? ' class="rbkTr"' : ''; ?>>
                                <td class="text-center">
                                    <?php
                                    echo Html::activeHiddenInput($modelKK, 'type', [
                                        'name' => "Body[type][]"
                                    ]);
                                    ?>
                                    <span class="<?php echo ($k == 1) ? 'rbkTrReplace' : 'rbRemove'; ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeDropDownList($modelKK, 'comp_prep_id', $kks, [
                                        'name' => "Body[comp_prep_id][]",
                                        'class' => $k == 0 ? 'width100' : 'select2 width100'
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeDropDownList($modelKK, 'blood_group', $bloodGroups, [
                                        'name' => "Body[blood_group][]",
                                        'class' => $k == 0 ? 'width100' : 'select2 width100'
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeDropDownList($modelKK, 'rh_factor', $rhFactors, [
                                        'name' => "Body[rh_factor][]",
                                        'class' => $k == 0 ? 'width100' : 'select2 width100'
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
                                        'class' => 'form-control width-100',
                                        'onkeyup' => 'onlyDigits(this)',
                                    ]);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo Html::activeTextInput($modelKK, 'quantity', [
                                        'name' => "Body[quantity][]",
                                        'class' => 'form-control width-100',
                                        'onkeyup' => 'onlyDigits(this)',
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
                            <th class="width-300">
                                <label>
                                    <?php echo Yii::t('common', 'Компонент'); ?>
                                    <span class="required">*</span>
                                </label>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['volume']; ?>
                                <span class="required">*</span>
                            </th>
                            <th class="width-100">
                                <?php echo $labels['quantity']; ?>
                                <span class="required">*</span>
                            </th>
                        </tr>
                        <?php foreach ($modelsPK as $k => $modelPK) : ?>
                            <tr<?php echo ($k == 0) ? ' class="rbpTr"' : ''; ?>>
                                <td class="text-center">
                                    <?php
                                    echo Html::activeHiddenInput($modelPK, 'type', [
                                        'name' => "Body[type][]"
                                    ]);
                                    ?>
                                    <span class="<?php echo ($k == 1) ? 'rbpTrReplace' : 'rbRemove'; ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </span>
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
                                    echo Html::activeTextInput($modelPK, 'quantity', [
                                        'name' => "Body[quantity][]",
                                        'class' => 'form-control width-100',
                                        'onkeyup' => 'onlyDigits(this)',
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