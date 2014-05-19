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
//            if (Yii::$app->session->get('role') == 1) {
//                return true;
//            }
//            $userId = Yii::$app->session->get('userId');
            // супер-администратор
            if (Yii::$app->user->identity->role == 'супер-администратор') {
                return true;
            }
            $userId = Yii::$app->user->identity->getId();
            $permissionName = $module . '-' . $controller . '-' . $action;
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
                    throw new ForbiddenHttpException(Yii::t('rbac', 'Не хватает прав!!!'), 403);
                }
            }
        } else {
            Yii::$app->getResponse()->redirect(Yii::$app->user->loginUrl);
        }
    }

}