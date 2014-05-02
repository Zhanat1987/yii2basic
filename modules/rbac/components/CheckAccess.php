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
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->identity->getId();
            $permissionName = $module . '-' . $controller . '-' . $action;
            $userId = Yii::$app->user->identity->getId();
            $permissionName = Yii::$app->controller->module->id . '-' .
                Yii::$app->controller->id . '-' . Yii::$app->controller->action->id;
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
        } else if ($module != 'user' && $controller != 'default' && $action != 'login') {
            Yii::$app->getResponse()->redirect(Yii::$app->user->loginUrl);
        }
    }

}