<?php

namespace app\modules\rbac\rules;

use yii\rbac\Rule;
use app\myhelpers\Debugger;

class DateTime extends Rule
{
    public $name = 'Ограничение по времени';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
//        Debugger::debug($user);
//        Debugger::debug($item->data);
//        Debugger::debug($item);
//        Debugger::stop($params);
        return mktime(21, 59, 0, 5, 17, 2014) < time();
    }
}