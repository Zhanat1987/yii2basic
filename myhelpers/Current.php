<?php

namespace app\myhelpers;

use Yii;
use yii\helpers\Url;

/**
 * Class Current
 * @package app\myhelpers
 * текущий помощник конкретного проекта
 */
class Current
{

    public function getStatuses($status = NULL)
    {
        $statuses = [
            1 => 'Опубликовано',
            0 => 'Не опубликовано',
        ];
        return $status !== NULL ? $statuses[$status] : $statuses;
    }

    public function getSideBarMenu()
    {
        $data       = [];
        $module     = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        if (Yii::$app->user->identity->role == 'супер-администратор') {
            if ($module == 'rbac' || $module == 'catalog') {
                $data[] = [
                    'url'    => Url::to('/gii/default/index'),
                    'label'  => Yii::t('common', 'Генератор кода'),
                    'icon'   => 'fa fa-wrench fa-fw',
                ];
                $data[] = [
                    'label'   => Yii::t('rbac', 'Права доступа'),
                    'icon'    => 'fa fa-key fa-fw',
                    'active' => $module == 'rbac',
                    'subMenu' => [
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
                    ],
                ];
                $data[] = [
                    'label'   => Yii::t('catalog', 'Справочники'),
                    'icon'    => 'fa fa-book fa-fw',
                    'active' => $module == 'catalog',
                    'subMenu' => [
                        [
                            'url'    => Url::to('/catalog/catalog/common'),
                            'label'  => Yii::t('catalog', 'Общие'),
                            'active' => $module == 'catalog' && $action == 'common',
                        ],
                        [
                            'url'    => Url::to('/catalog/catalog/organization'),
                            'label'  => Yii::t('catalog', 'По организациям'),
                            'active' => $module == 'catalog' && $action == 'organization',
                        ],
                        [
                            'url'    => Url::to('/catalog/mkb10/index'),
                            'label'  => Yii::t('catalog', 'МКБ 10'),
                            'active' => $module == 'catalog' && $controller == 'mkb10',
                        ],
                    ],
                ];
            }
            if (($module == 'user' && $controller == 'user') || $module == 'organization') {
                $data[] = [
                    'url'    => Url::to('/user/user/index'),
                    'label'  => Yii::t('user', 'Пользователи'),
                    'icon'   => 'fa fa-users fa-fw',
                    'active' => $module == 'user',
                ];
                $data[] = [
                    'url'    => Url::to('/organization/organization/index'),
                    'label'  => Yii::t('organization', 'Организации'),
                    'icon'   => 'fa fa-hospital-o fa-fw',
                    'active' => $module == 'organization',
                ];
            }
        }
        return $data;
    }

    public function getHeaderMenu()
    {
        $data       = [];
        $module     = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        if (Yii::$app->user->identity->role == 'супер-администратор') {
            $data[] = [
                'label'   => Yii::t('common', 'Настройки'),
                'icon'    => 'fa fa-cog',
                'active' => $module == 'rbac' || $module == 'catalog',
                'subMenu' => [
                    [
                        'url'   => Url::to('/gii/default/index'),
                        'label' => Yii::t('common', 'Генератор кода'),
                        'icon'  => 'fa fa-wrench',
                    ],
                    [
                        'label'   => Yii::t('rbac', 'Права доступа'),
                        'icon'    => 'fa fa-key',
                    ],
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
                        'label'  => Yii::t('catalog', 'Справочники'),
                        'icon'   => 'fa fa-book',
                    ],
                    [
                        'url'    => Url::to('/catalog/catalog/common'),
                        'label'  => Yii::t('catalog', 'Общие'),
                        'active' => $module == 'catalog' && $action == 'common',
                    ],
                    [
                        'url'    => Url::to('/catalog/catalog/organization'),
                        'label'  => Yii::t('catalog', 'По организациям'),
                        'active' => $module == 'catalog' && $action == 'organization',
                    ],
                    [
                        'url'    => Url::to('/catalog/mkb10/index'),
                        'label'  => Yii::t('catalog', 'МКБ 10'),
                        'active' => $module == 'catalog' && $controller == 'mkb10',
                    ],
                ],
            ];
            $data[] = [
                'label'   => Yii::t('common', 'Администрирование'),
                'icon'    => 'fa fa-cog',
                'active' => ($module == 'user' && $controller == 'user') ||
                    $module == 'organization',
                'subMenu' => [
                    [
                        'url'    => Url::to('/user/user/index'),
                        'label'  => Yii::t('user', 'Пользователи'),
                        'icon'   => 'fa fa-users',
                        'active' => $module == 'user' && $controller == 'user',
                    ],
                    [
                        'url'    => Url::to('/organization/organization/index'),
                        'label'  => Yii::t('organization', 'Организации'),
                        'icon'   => 'fa fa-hospital-o',
                        'active' => $module == 'organization',
                    ],
                ],
            ];
        }
        return $data;
    }

    public function getLabel($k = NULL)
    {
        $values = [
            1  => 'success',
            0  => 'danger',
            -1 => 'default',
        ];
        return $k !== NULL ? $values[$k] : 'success';
    }

    public function filterDefaultValue($data)
    {
        return array_replace(['' => 'Все'], $data);
    }

    public function getDate($timestamp = NULL)
    {
        return $timestamp !== NULL ? date('d/m/Y', $timestamp) : date('d/m/Y');
    }

    public function getDateInterval($date)
    {
        list($month, $day, $year) = explode('/', $date);
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        return [$timestamp, $timestamp + 86400];
    }

}