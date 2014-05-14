<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 03.05.14
 * Time: 9:38
 */

namespace app\modules\rbac\components;

class Generator
{

    /**
     * http://www.yiiframework.com/extension/metadata/
     * http://de3.php.net/manual/ru/reflectionclass.getnamespacename.php
     * http://www.yiiframework.com/forum/index.php/topic/10540-how-dan-i-list-controller-and-actions/
     * http://www.php.net/manual/ru/function.scandir.php
     * модуль yii-rights
     */
    public static function execute()
    {
        $modulesPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR;
        if (is_dir($modulesPath)) {
            $modules = scandir($modulesPath);
            if (sizeof($modules) > 2) {
                $auth = \Yii::$app->authManager;
//                $auth->removeAll();
                $auth->removeAllPermissions();
                foreach ($modules as $module) {
                    // только директории
                    if (strpos($module, '.') !== false) {
                        continue;
                    }
                    $modulePermissionName = 'модуль - ' . $module;
                    // все модули создать как разрешения
                    $modulePermission = $auth->createPermission($modulePermissionName);
                    $modulePermission->description = 'описание: ' . $modulePermissionName;
                    $auth->add($modulePermission);
                    $controllersPath = $modulesPath . $module .
                        DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR;
                    if (is_dir($controllersPath)) {
                        $controllersInModule = scandir($controllersPath);
                        if (sizeof($controllersInModule) > 2) {
                            foreach ($controllersInModule as $controller) {
                                // не учитывать текущую и родительскую директории
                                if ($controller == '.' || $controller == '..') {
                                    continue;
                                }
                                $controllerFile = $controllersPath . $controller;
                                $controller = strtolower($controller);
                                // соответствие имени файла контроллера
                                if (strpos($controller, 'controller') !== false) {
                                    $controller = substr($controller, 0, -14);
                                    $controllerPermissionName = $modulePermissionName .
                                        ', контроллер - ' . $controller;
                                    // все контроллеры создать как разрешения
                                    $controllerPermission =
                                        $auth->createPermission($controllerPermissionName);
                                    $controllerPermission->description = 'описание: ' .
                                        $controllerPermissionName;
                                    $auth->add($controllerPermission);
                                    /**
                                     * к разрешению модуля добавить его
                                     * контроллеры как дочерние разрешения
                                     */
                                    $auth->addChild($modulePermission, $controllerPermission);
                                    // действия контроллера
                                    $file = fopen($controllerFile, 'r');
                                    while (feof($file) === false) {
                                        $line = fgets($file);
                                        preg_match(
                                            '/public[ \t]+function[ \t]+action([A-Z]{1}' .
                                            '[a-zA-Z0-9]+)[ \t]*\(/',
                                            $line, $matches);
                                        if ($matches !== array()) {
                                            $action = strtolower($matches[1]);
                                            $actionPermissionName = $controllerPermissionName .
                                                ', действие - ' . $action;
                                            // все действия создать как разрешения
                                            $actionPermission =
                                                $auth->createPermission($actionPermissionName);
                                            $actionPermission->description = 'описание: ' .
                                                $actionPermissionName;
                                            $auth->add($actionPermission);
                                            /**
                                             * к разрешению контроллер добавить его
                                             * действия как дочерние разрешения
                                             */
                                            $auth->addChild($controllerPermission, $actionPermission);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

} 