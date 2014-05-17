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

    public static function getStatuses($status = NULL)
    {
        $statuses = [
            1 => 'Опубликовано',
            0 => 'Не опубликовано',
        ];
        return $status !== NULL ? $statuses[$status] : $statuses;
    }

    public static function getSideBarMenu()
    {
        $data   = [];
        $module = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        if (Yii::$app->user->identity->role == 'супер-администратор') {
            $data[] = [
                'url'    => Url::to('/gii/default/index'),
                'label'  => Yii::t('common', 'Генератор кода'),
                'icon'   => 'fa fa-wrench fa-fw',
            ];
            $data[] = [
                'label'  => Yii::t('rbac', 'Права доступа'),
                'icon'   => 'fa fa-key fa-fw',
                'subMenu'    => [
                    [
                        'url'    => Url::to('/rbac/auth-rule/index'),
                        'label'  => Yii::t('rbac', 'Правила'),
                        'active' => $module == 'rbac' && $controller == 'auth-rule',
                    ],
                    [
                        'url'    => Url::to('/rbac/auth-item/index'),
                        'label'  => Yii::t('rbac', 'Роли и разрешения'),
                        'active' => $module == 'rbac' && $controller == 'auth-item',
                    ],
                    [
                        'url'    => Url::to('/rbac/auth-item-child/index'),
                        'label'  => Yii::t('rbac', 'Иерархия'),
                        'active' => $module == 'rbac' && $controller == 'auth-item-child',
                    ],
                    [
                        'url'    => Url::to('/rbac/auth-assignment/index'),
                        'label'  => Yii::t('rbac', 'Назначить права доступа'),
                        'active' => $module == 'rbac' && $controller == 'auth-assignment',
                    ],
                    [
                        'url'    => Url::to('/rbac/default/index'),
                        'label'  => Yii::t('rbac', 'App Rules'),
                        'active' => $module == 'rbac' && $controller == 'default',
                    ],
                ],
            ];
        }
        if ($module == 'user' || $module == 'organization') {
            $data[] = [
                'url'    => Url::to('/user/user/index'),
                'label'  => Yii::t('user', 'Пользователи'),
                'icon'   => 'fa fa-user fa-fw',
                'active' => $module == 'user',
            ];
            $data[] = [
                'url'    => Url::to('/organization/default/index'),
                'label'  => Yii::t('organization', 'Организации'),
                'active' => $module == 'organization',
            ];
        }
        return $data;
    }

    public static function getLabel($k = NULL)
    {
        $values = [
            1  => 'success',
            0  => 'danger',
            -1 => 'default',
        ];
        return $k !== NULL ? $values[$k] : 'success';
    }

    public static function filterDefaultValue($data)
    {
        return array_replace(['' => 'Все'], $data);
    }

}