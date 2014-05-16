<?php

namespace app\modules\rbac\components;

use Yii;
use app\myhelpers\Debugger;
use yii\web\ForbiddenHttpException;

class CheckAccess
{

    /**
     * @return bool
     * проверка доступа
     */
    public static function execute()
    {
        return true;
        /**
         * Yii::$app->requestedRoute:
         * http://yii2.basic2/rbac/auth-rule/update/1: "rbac/auth-rule/update/1"
         * http://yii2.basic2/rbac/auth-rule/index: "rbac/auth-rule/index"
         * http://yii2.basic2/rbac/auth-rule/index/: "rbac/auth-rule/index/"
         * http://yii2.basic2/: ""
         * http://yii2.basic2: ""
         * http://yii2.basic2/rbac/auth-rule/index?test=1: "rbac/auth-rule/index"
         */
        $module = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        /**
         * страницы авторизации, ошибки, разлогирования и
         * главная страница - доступны всем пользователям
         */
        if ($module == 'user' && $controller == 'default' && ($action == 'login'
                || $action == 'error' || $action == 'logout')) {
            return true;
        }
        if (!Yii::$app->user->isGuest) {
            if ($module == 'user' && $controller == 'default' && $action == 'index') {
                return true;
            }
//            // супер-администратор
//            if (Yii::$app->session->get('role') == 1) {
//                return true;
//            }
//            $userId = Yii::$app->session->get('userId');
            // супер-администратор
            if (Yii::$app->user->identity->role == 'супер-администратор') {
                return true;
            }
            $userId = Yii::$app->user->identity->getId();
            $moduleRBAC = 'модуль - ' . $module;
            $controllerRBAC = ', контроллер - ' . str_replace('-', '', $controller);
            $actionRBAC = ', действие - ' . str_replace('-', '', $action);
            $permissionName = $moduleRBAC . '-' . $controllerRBAC . '-' . $actionRBAC;
            $params = [];
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            if ($id) {
                $params['id'] = $id;
            }
            $can = Yii::$app->authManager->checkAccess($userId, $permissionName, $params);
            if ($can) {
                return true;
            } else {
                if (Yii::$app->request->isAjax || Yii::$app->request->isPjax) {
                    return false;
                } else {
                    throw new ForbiddenHttpException('Не хватает прав!!!', 403);
                }
            }
        } else {
            Yii::$app->getResponse()->redirect(Yii::$app->user->loginUrl);
        }
    }

}