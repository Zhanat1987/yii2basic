<?php
use yii\helpers\Url;
?>
<!-- HEADER -->
<header class="navbar clearfix" id="header">
    <div class="container">
        <div class="navbar-brand">
            <!-- COMPANY LOGO -->
            <a href="<?php echo Yii::$app->homeUrl; ?>" class="logoA">
                <?php echo Yii::$app->id; ?>
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
                    <img alt="" src="<?php echo Yii::getAlias('@cloud'); ?>/img/avatars/avatar3.jpg"/>
                    <span class="username">
                        <?php echo Yii::$app->user->identity->username; ?>
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-user"></i> My Profile</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Account Settings</a></li>
                    <li><a href="#"><i class="fa fa-eye"></i> Privacy Settings</a></li>
                    <li>
                        <a href="<?php echo Url::to('/user/default/logout'); ?>" data-method="post">
                            <i class="fa fa-power-off"></i>
                            &nbsp;Выйти
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