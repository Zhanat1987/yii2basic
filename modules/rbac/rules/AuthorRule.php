<?php

namespace app\modules\rbac\rules;

use yii\rbac\Rule;
use app\myhelpers\Debugger;

/**
 * Checks if authorID matches user passed via params
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $result = (new \yii\db\Query())
            ->select('id')
            ->from($item->data)
            ->where('created_by = ' . $user . ' AND id = ' . $params['id'])
            ->limit(1)
            ->exists();
//        Debugger::stop($result);
        return $result;
    }
}