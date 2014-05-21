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
        <span class="input-group-btn">
            <a class="btn btn-default" id="mL<?php echo $id; ?>" href="#">
                <i class="fa fa-list-ul"></i>
            </a>
        </span>
    </p>
    <div class="help-block"></div>
</div>