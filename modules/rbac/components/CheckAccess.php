<?php

namespace app\modules\rbac\components;

use Yii;
use yii\web\ForbiddenHttpException;

class CheckAccess
{

    /**
     * @return bool
     * проверка доступа
     */
    public static function execute()
    {
        $module = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        if ($module == 'user' && $controller == 'allow') {
            return true;
        }
        if (!Yii::$app->user->isGuest) {
            if ($module == 'user' && $controller == 'deny') {
                return true;
            }
            // супер-администратор
            if (Yii::$app->session->get('role') == 'супер-администратор') {
                return true;
            }
            // администратор
            if (Yii::$app->session->get('role') == 'администратор' && $module != 'rbac') {
                return true;
            }
            $organizationId = Yii::$app->session->get('organizationId');
            $permissionName = $module . '-' . $controller . '-' . $action;
            $params = [];
            $id = (int) Yii::$app->request->getQueryParam('id', 0);
            if ($id) {
                $params['id'] = $id;
            }
            $can = Yii::$app->authManager->checkAccess($organizationId, $permissionName, $params);
            if ($can) {
                return true;
            } else {
                if (Yii::$app->request->isAjax || Yii::$app->request->isPjax) {
                    return false;
                } else {
                    throw new ForbiddenHttpException(Yii::t('rbac', 'Не хватает прав!!!'), 403);
                }
            }
        } else {
            Yii::$app->getResponse()->redirect(Yii::$app->user->loginUrl);
        }
    }

}