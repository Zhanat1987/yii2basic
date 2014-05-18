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
                        <a href="<?php echo Url::to('/user/default/profile'); ?>">
                            <i class="fa fa-user"></i>
                            <?php echo Yii::t('common', 'Профиль'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to('/user/default/logout'); ?>" data-method="post">
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