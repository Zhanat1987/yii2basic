<?php

namespace app\myhelpers;

use Yii;
use app\myhelpers\Debugger;
use yii\helpers\Url;

/**
 * Class Current
 * @package app\myhelpers
 * текущий помощник конкретного проекта
 */
class Current
{

    public static function getStatuses($status = null)
    {
        $statuses = [
            1 => 'Опубликовано',
            0 => 'Не опубликовано',
        ];
        return $status !== null ? $statuses[$status] : $statuses;
    }

    public static function getSideBarMenu()
    {
        $data = [];
        $module = Yii::$app->controller->module->id;
        if ($module == 'user' || $module == 'organization') {
            $data = [
                [
                    'url' => Url::to('/user/user/index'),
                    'label' => Yii::t('user', 'Пользователи'),
                    'icon' => 'fa fa-user fa-fw',
                    'active' => $module == 'user',
                ],
                [
                    'url' => Url::to('/organization/default/index'),
                    'label' => Yii::t('organization', 'Организации'),
                    'active' => $module == 'organization',
                ],
            ];
        }
        return $data;
    }

}