<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-menu nav-collapse">
        <div class="divide-20"></div>
        <!-- SIDEBAR MENU -->
        <ul>
            <?php if ($menu) : ?>
                <?php foreach ($menu as $item) : ?>
                    <?php if (isset($item['subMenu'])) : ?>
                        <?php if (isset($item['active']) && $item['active']) : ?>
                            <li class="has-sub active">
                        <?php else : ?>
                            <li class="has-sub">
                        <?php endif; ?>
                            <a href="javascript:;">
                                <i class="<?php echo $item['icon']; ?>"></i>
                                <span class="menu-text">
                                    <?php echo $item['label']; ?>
                                </span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <?php foreach ($item['subMenu'] as $subMenuItem) : ?>
                                    <?php if (isset($subMenuItem['active']) &&
                                        $subMenuItem['active']) : ?>
                                        <?php if (isset($subMenuItem['subSubMenu'])) : ?>
                                            <li class="has-sub-sub active">
                                        <?php else : ?>
                                            <li class="active">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (isset($subMenuItem['subSubMenu'])) : ?>
                                            <li class="has-sub-sub">
                                        <?php else : ?>
                                            <li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                        <?php if (isset($subMenuItem['subSubMenu'])) : ?>
                                            <a href="javascript:;">
                                                <span class="sub-menu-text">
                                                    <?php echo $subMenuItem['label']; ?>
                                                </span>
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="sub-sub">
                                                <?php foreach ($subMenuItem['subSubMenu'] as $subSubMenuItem) : ?>
                                                    <?php if (isset($subSubMenuItem['active']) &&
                                                        $subSubMenuItem['active']) : ?>
                                                        <li class="active">
                                                    <?php else : ?>
                                                        <li>
                                                    <?php endif; ?>
                                                            <a href="<?php echo $subSubMenuItem['url']; ?>">
                                                                <span class="sub-sub-menu-text">
                                                                    <?php echo $subSubMenuItem['label']; ?>
                                                                </span>
                                                            </a>
                                                        </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else : ?>
                                            <a href="<?php echo $subMenuItem['url']; ?>">
                                                <span class="sub-menu-text">
                                                    <?php echo $subMenuItem['label']; ?>
                                                </span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else : ?>
                        <?php if (isset($item['active']) && $item['active']) : ?>
                            <li class="active">
                        <?php else : ?>
                            <li>
                        <?php endif; ?>
                                <a href="<?php echo $item['url']; ?>">
                                    <?php if (isset($item['icon'])) : ?>
                                        <i class="<?php echo $item['icon']; ?>"></i>
                                    <?php endif; ?>
                                    <span class="menu-text">
                                        <?php echo $item['label']; ?>
                                    </span>
                                </a>
                            </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <!-- /SIDEBAR MENU -->
    </div>
</div>
<!-- /SIDEBAR -->