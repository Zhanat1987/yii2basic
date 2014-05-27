<?php
\app\assets\PhenotypeAsset::register($this);
?>
<div class="input-group">
    <input type="text"
           class="form-control phenotype"
           readonly="readonly"
           maxlength="8"
           name="<?php echo $name; ?>"
           value="<?php echo $value; ?>" />
    <span class="input-group-btn">
        <a class="btn btn-default phenotype-btn" href="#">
            <i class="fa fa-list-ul"></i>
        </a>
    </span>
</div>