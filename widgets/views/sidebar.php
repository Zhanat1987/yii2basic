<?php
use yii\helpers\Url;
?>
<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-menu nav-collapse">
        <div class="divide-20"></div>
        <!-- SIDEBAR MENU -->
        <ul>
            <li>
                <a class="" href="<?php echo Url::to('/gii/default/index'); ?>" target="_blank">
                    <i class="fa fa-desktop fa-fw"></i>
                    <span class="menu-text">
                        Gii
                    </span>
                </a>
            </li>
            <li>
                <a class="" href="<?php echo Url::to('/user/user/index'); ?>">
                    <i class="fa fa-user fa-fw"></i>
                    <span class="menu-text">
                        Пользователи
                    </span>
                </a>
            </li>
            <li class="has-sub">
                <a href="javascript:;" class="">
                    <i class="fa fa-table fa-fw"></i>
                    <span class="menu-text">
                        Rbac
                    </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li>
                        <a href="<?php echo Url::to('/article/article/index'); ?>">
                            <span class="sub-menu-text">
                                Articles
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to('/rbac/default/index'); ?>">
                            <span class="sub-menu-text">
                                App Rules
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to('/rbac/auth-rule/index'); ?>">
                            <span class="sub-menu-text">
                                Auth Rule
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to('/rbac/auth-item/index'); ?>">
                            <span class="sub-menu-text">
                                Auth Item
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to('/rbac/auth-item-child/index'); ?>">
                            <span class="sub-menu-text">
                                Auth Item Child
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to('/rbac/auth-assignment/index'); ?>">
                            <span class="sub-menu-text">
                                Auth Assignment
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /SIDEBAR MENU -->
    </div>
</div>
<!-- /SIDEBAR -->