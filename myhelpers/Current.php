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
        if (Yii::$app->session->get('role') == 'супер-администратор') {
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
                            'label'  => Yii::t('catalog', 'Общие'),
                            'active' => $module == 'catalog' && $action == 'common',
                            'subSubMenu' => [
                                [
                                    'url'    => Url::to('/catalog/catalog/common/1'),
                                    'label'  => Yii::t('catalog', 'Область'),
                                    'active' => $module == 'catalog' && $action == 'common'
                                        && Yii::$app->request->getQueryParam('type', '') == 1,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/common/3'),
                                    'label'  => Yii::t('catalog', 'Адм. ед. области'),
                                    'active' => $module == 'catalog' && $action == 'Город'
                                        && Yii::$app->request->getQueryParam('type', '') == 3,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/common/4'),
                                    'label'  => Yii::t('catalog', 'Улица'),
                                    'active' => $module == 'catalog' && $action == 'common'
                                        && Yii::$app->request->getQueryParam('type', '') == 4,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/common/5'),
                                    'label'  => Yii::t('catalog', 'Дефект'),
                                    'active' => $module == 'catalog' && $action == 'common'
                                        && Yii::$app->request->getQueryParam('type', '') == 5,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/common/6'),
                                    'label'  => Yii::t('catalog', 'Результат лечения'),
                                    'active' => $module == 'catalog' && $action == 'common'
                                        && Yii::$app->request->getQueryParam('type', '') == 6,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/common/7'),
                                    'label'  => Yii::t('catalog', 'Документ'),
                                    'active' => $module == 'catalog' && $action == 'common'
                                        && Yii::$app->request->getQueryParam('type', '') == 7,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/common/8'),
                                    'label'  => Yii::t('catalog', 'Кем выдан'),
                                    'active' => $module == 'catalog' && $action == 'common'
                                        && Yii::$app->request->getQueryParam('type', '') == 8,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/common/9'),
                                    'label'  => Yii::t('catalog', 'Гражданство'),
                                    'active' => $module == 'catalog' && $action == 'common'
                                        && Yii::$app->request->getQueryParam('type', '') == 9,
                                ],
                                [
                                    'url'    => Url::to('/catalog/comp-prep/index'),
                                    'label'  => Yii::t('catalog', 'Компоненты/препараты'),
                                    'active' => $module == 'catalog' && $controller == 'comp-prep',
                                ],
                            ],
                        ],
                        [
                            'label'  => Yii::t('catalog', 'По организациям'),
                            'active' => $module == 'catalog' && $action == 'organization',
                            'subSubMenu' => [
                                [
                                    'url'    => Url::to('/catalog/catalog/organization/10'),
                                    'label'  => Yii::t('catalog', 'Отделение'),
                                    'active' => $module == 'catalog' && $action == 'organization'
                                        && Yii::$app->request->getQueryParam('type', '') == 10,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/organization/11'),
                                    'label'  => Yii::t('catalog', 'Поликлиника прикрепления'),
                                    'active' => $module == 'catalog' && $action == 'organization'
                                        && Yii::$app->request->getQueryParam('type', '') == 11,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/organization/12'),
                                    'label'  => Yii::t('catalog', 'Показания'),
                                    'active' => $module == 'catalog' && $action == 'organization'
                                        && Yii::$app->request->getQueryParam('type', '') == 12,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/organization/13'),
                                    'label'  => Yii::t('catalog', 'Цель'),
                                    'active' => $module == 'catalog' && $action == 'organization'
                                        && Yii::$app->request->getQueryParam('type', '') == 13,
                                ],
                                [
                                    'url'    => Url::to('/catalog/catalog/organization/14'),
                                    'label'  => Yii::t('catalog', 'Способ утилизации'),
                                    'active' => $module == 'catalog' && $action == 'organization'
                                        && Yii::$app->request->getQueryParam('type', '') == 14,
                                ],
                                [
                                    'url'    => Url::to('/catalog/personal/index'),
                                    'label'  => Yii::t('catalog', 'Персонал'),
                                    'active' => $module == 'catalog' && $controller == 'personal',
                                ],
                            ],
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
            if ($module == 'request' || $module == 'waybill'
                || $module == 'blood-storage' || $module == 'recipient') {
                $data[] = [
                    'url'    => Url::to('/request/request/index'),
                    'label'  => Yii::t('request', 'Заявки'),
                    'icon'   => 'fa fa-pencil-square-o fa-fw',
                    'active' => $module == 'request',
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
        if (Yii::$app->session->get('role') == 'супер-администратор') {
            $data[] = [
                'label'   => Yii::t('common', 'Настройки'),
                'icon'    => 'fa fa-keyboard-o',
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
                        'label'  => Yii::t('catalog', 'Общие'),
                        'active' => $module == 'catalog' && $action == 'common',
                        'url'    => '#',
                        'subSubMenu' => [
                            [
                                'url'    => Url::to('/catalog/catalog/common/1'),
                                'label'  => Yii::t('catalog', 'Область'),
                                'active' => $module == 'catalog' && $action == 'common'
                                    && Yii::$app->request->getQueryParam('type', '') == 1,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/common/3'),
                                'label'  => Yii::t('catalog', 'Адм. ед. области'),
                                'active' => $module == 'catalog' && $action == 'Город'
                                    && Yii::$app->request->getQueryParam('type', '') == 3,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/common/4'),
                                'label'  => Yii::t('catalog', 'Улица'),
                                'active' => $module == 'catalog' && $action == 'common'
                                    && Yii::$app->request->getQueryParam('type', '') == 4,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/common/5'),
                                'label'  => Yii::t('catalog', 'Дефект'),
                                'active' => $module == 'catalog' && $action == 'common'
                                    && Yii::$app->request->getQueryParam('type', '') == 5,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/common/6'),
                                'label'  => Yii::t('catalog', 'Результат лечения'),
                                'active' => $module == 'catalog' && $action == 'common'
                                    && Yii::$app->request->getQueryParam('type', '') == 6,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/common/7'),
                                'label'  => Yii::t('catalog', 'Документ'),
                                'active' => $module == 'catalog' && $action == 'common'
                                    && Yii::$app->request->getQueryParam('type', '') == 7,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/common/8'),
                                'label'  => Yii::t('catalog', 'Кем выдан'),
                                'active' => $module == 'catalog' && $action == 'common'
                                    && Yii::$app->request->getQueryParam('type', '') == 8,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/common/9'),
                                'label'  => Yii::t('catalog', 'Гражданство'),
                                'active' => $module == 'catalog' && $action == 'common'
                                    && Yii::$app->request->getQueryParam('type', '') == 9,
                            ],
                            [
                                'url'    => Url::to('/catalog/comp-prep/index'),
                                'label'  => Yii::t('catalog', 'Компоненты/препараты'),
                                'active' => $module == 'catalog' && $controller == 'comp-prep',
                            ],
                        ],
                    ],
                    [
                        'label'  => Yii::t('catalog', 'По организациям'),
                        'active' => $module == 'catalog' && $action == 'organization',
                        'url'    => '#',
                        'subSubMenu' => [
                            [
                                'url'    => Url::to('/catalog/catalog/organization/10'),
                                'label'  => Yii::t('catalog', 'Отделение'),
                                'active' => $module == 'catalog' && $action == 'organization'
                                    && Yii::$app->request->getQueryParam('type', '') == 10,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/organization/11'),
                                'label'  => Yii::t('catalog', 'Поликлиника прикрепления'),
                                'active' => $module == 'catalog' && $action == 'organization'
                                    && Yii::$app->request->getQueryParam('type', '') == 11,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/organization/12'),
                                'label'  => Yii::t('catalog', 'Показания'),
                                'active' => $module == 'catalog' && $action == 'organization'
                                    && Yii::$app->request->getQueryParam('type', '') == 12,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/organization/13'),
                                'label'  => Yii::t('catalog', 'Цель'),
                                'active' => $module == 'catalog' && $action == 'organization'
                                    && Yii::$app->request->getQueryParam('type', '') == 13,
                            ],
                            [
                                'url'    => Url::to('/catalog/catalog/organization/14'),
                                'label'  => Yii::t('catalog', 'Способ утилизации'),
                                'active' => $module == 'catalog' && $action == 'organization'
                                    && Yii::$app->request->getQueryParam('type', '') == 14,
                            ],
                            [
                                'url'    => Url::to('/catalog/personal/index'),
                                'label'  => Yii::t('catalog', 'Персонал'),
                                'active' => $module == 'catalog' && $controller == 'personal',
                            ],
                        ],
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
            $data[] = [
                'label'   => Yii::t('common', 'Стационар'),
                'icon'    => 'fa fa-medkit',
                'active' => $module == 'request' || $module == 'waybill'
                    || $module == 'blood-storage' || $module == 'recipient',
                'subMenu' => [
                    [
                        'url'   => Url::to('/request/request/index'),
                        'label' => Yii::t('request', 'Заявки'),
                        'icon'  => 'fa fa-pencil-square-o',
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

    public function defaultValue($data, $filter = true)
    {
        return array_replace(['' => $filter ? Yii::t('common', 'Все') : ''], $data);
    }

    public function getDate($timestamp = NULL)
    {
        return $timestamp !== NULL ? date('d/m/Y', $timestamp) : date('d/m/Y');
    }

    public function getDateInterval($date)
    {
        list($day, $month, $year) = explode('/', $date);
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        return [$timestamp, $timestamp + 86400];
    }

    public function setDate($date = null)
    {
        if (!$date) {
            return time();
        }
        $pattern = '/(\d\d)\/(\d\d)\/(\d\d\d\d) \((\d\d):(\d\d)\)/';
        $pattern2 = '/(\d\d)\/(\d\d)\/(\d\d\d\d)/';
        if (strlen($date) == 18 && preg_match($pattern, $date, $matches)) {
            return mktime($matches[4], $matches[5], 0, $matches[2], $matches[1], $matches[3]);
        } else if (strlen($date) == 10 && preg_match($pattern2, $date, $matches)) {
            if (strpos(Yii::app()->getDb()->connectionString, 'mysql') === 0) {
                $rightDate = $matches[3] . '-' . $matches[2] . '-' . $matches[1] . ' 00:00:00';
            } else if (strpos(Yii::app()->getDb()->connectionString, 'sqlsrv') === 0) {
                $rightDate = $matches[3] . $matches[2] . $matches[1] . ' 00:00:00';
            }
            return mktime(0, 0, 0, $matches[2], $matches[1], $matches[3]);
        } else {
            return time();
        }
    }

    public function getDateTime($timestamp, $withTime = true)
    {
        return $withTime ? date('d/m/Y (H:i)', $timestamp) : date('d/m/Y', $timestamp);
    }

    public function getBloodGroup($k = null, $filter = true)
    {
        $data = [
            1 => Yii::t('common', '0'),
            2 => Yii::t('common', 'A'),
            3 => Yii::t('common', 'B'),
            4 => Yii::t('common', 'AB')
        ];
        return $k !== null ? $data[$k] : $this->defaultValue($data, $filter);
    }

    public function getRhFactor($k = null, $filter = true)
    {
        $data = [
            1 => Yii::t('common', 'Rh+ (положительный)'),
            2 => Yii::t('common', 'Rh- (отрицательный)')
        ];
        return $k !== null ? $data[$k] : $this->defaultValue($data, $filter);
    }

}