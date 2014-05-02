<?php

namespace app\components;

use yii\web\Controller;
use app\modules\rbac\components\CheckAccess;
use app\myhelpers\Debugger;
use yii\base\View;

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
//        Debugger::stop(\Yii::$aliases);
//        Debugger::stop(\Yii::$app->getLayoutPath());
//        Debugger::stop($this->getModules());
//        Debugger::stop(new View);
        return true;
//        if (parent::beforeAction($action) && CheckAccess::execute()) {
//            return true;
//        } else {
//            return false;
//        }
    }

} 