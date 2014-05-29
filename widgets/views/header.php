<?php
use yii\helpers\Url;
?>
<!-- HEADER -->
<header class="navbar clearfix" id="header">
    <div class="container">
        <div class="navbar-brand">
            <!-- COMPANY LOGO -->
            <a href="/">
                <img width="120" height="30" class="img-responsive" alt="Info Blood"
                     src="<?php echo Yii::getAlias('@web'); ?>/img/logo.png">
            </a>
            <!-- /COMPANY LOGO -->
            <!-- SIDEBAR COLLAPSE -->
            <div id="sidebar-collapse" class="sidebar-collapse btn">
                <i class="fa fa-bars"
                   data-icon1="fa fa-bars"
                   data-icon2="fa fa-bars"></i>
            </div>
            <!-- /SIDEBAR COLLAPSE -->
        </div>
        <ul id="navbar-left" class="nav navbar-nav pull-left hidden-xs">
            <?php if ($menu) : ?>
                <?php foreach ($menu as $item) : ?>
                    <?php
                    if (isset($item['visible']) && !$item['visible']) {
                        continue;
                    }
                    ?>
                    <?php if (isset($item['subMenu'])) : ?>
                        <?php if (isset($item['active']) && $item['active']) : ?>
                            <li class="dropdown">
                        <?php else : ?>
                            <li>
                        <?php endif; ?>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="<?php echo $item['icon']; ?>"></i>
                                    <span class="name">
                                        <?php echo $item['label']; ?>
                                    </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu skins">
                                    <?php foreach ($item['subMenu'] as $subMenuItem) : ?>
                                        <?php
                                        if (isset($subMenuItem['visible']) && !$subMenuItem['visible']) {
                                            continue;
                                        }
                                        ?>
                                        <?php if (isset($subMenuItem['url'])) : ?>
                                            <?php if (isset($subMenuItem['active']) &&
                                                $subMenuItem['active']) : ?>
                                                <?php if (isset($subMenuItem['subSubMenu'])) : ?>
                                                    <li class="dropdown-submenu active">
                                                <?php else : ?>
                                                    <li class="active">
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if (isset($subMenuItem['subSubMenu'])) : ?>
                                                    <li class="dropdown-submenu">
                                                <?php else : ?>
                                                    <li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <li class="dropdown-title">
                                        <?php endif; ?>
                                                <?php if (isset($subMenuItem['url'])) : ?>
                                                    <a href="<?php echo $subMenuItem['url']; ?>">
                                                <?php else : ?>
                                                    <span>
                                                <?php endif; ?>
                                                    <?php if (isset($subMenuItem['icon'])) : ?>
                                                        <i class="<?php echo
                                                        $subMenuItem['icon']; ?>"></i>
                                                    <?php endif; ?>
                                                    <?php echo $subMenuItem['label']; ?>
                                                    <?php if (isset($subMenuItem['url'])) : ?>
                                                        </a>
                                                    <?php else : ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if (isset($subMenuItem['subSubMenu'])) : ?>
                                                        <ul class="dropdown-menu">
                                                        <?php foreach ($subMenuItem['subSubMenu'] as
                                                                       $subSubMenuItem) : ?>
                                                            <?php
                                                            if (isset($subSubMenuItem['visible']) &&
                                                                !$subSubMenuItem['visible']) {
                                                                continue;
                                                            }
                                                            ?>
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
                                                    <?php endif; ?>
                                            </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                    <?php else : ?>
                        <?php if (isset($item['active']) && $item['active']) : ?>
                            <li class="dropdown">
                        <?php else : ?>
                            <li>
                        <?php endif; ?>
                                <a href="<?php echo $item['url']; ?>" class="dropdown-toggle">
                                    <?php if (isset($item['icon'])) : ?>
                                        <i class="<?php echo $item['icon']; ?>"></i>
                                    <?php endif; ?>
                                    <span class="name">
                                        <?php echo $item['label']; ?>
                                    </span>
                                </a>
                            </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right userLi">
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user" id="header-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="username">
                        <?php echo Yii::$app->user->identity->username; ?>
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <?php
                //Yii::$app->language = 'kz-KZ';
                //Yii::$app->language = 'en-EN';
                ?>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo Url::to(['/user/deny/profile']); ?>">
                            <i class="fa fa-user"></i>
                            <?php echo Yii::t('common', 'Профиль'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to(['/user/deny/logout']); ?>" data-method="post">
                            <i class="fa fa-power-off"></i>
                            <?php echo Yii::t('common', 'Выйти'); ?>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
        <!-- END TOP NAVIGATION MENU -->
    </div>
</header>
<!--/HEADER -->