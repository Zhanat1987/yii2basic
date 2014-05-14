<?php

namespace app\components;

use yii\web\Controller;
use app\modules\rbac\components\CheckAccess;
use app\myhelpers\Debugger;

class MyController extends Controller
{

    /**
     * @return bool|void
     * parent::init() - относится к yii\base\Object, который яв-ся просто заглушкой,
     * поэтому его нет смысла вызывать.
     * init() вызывается сразу после вызова конструктора
     * Yii::$app->controller === null в методе init(), поэтому не получается
     * определить текущие: модуль, контроллер и действие
     */
    public function init()
    {
        return true;
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action) && CheckAccess::execute()) {
            return true;
        } else {
            return false;
        }
    }

} 