<?php

namespace app\modules\rbac\rules;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class Author extends Rule
{

    public $name = 'Автор';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits
     * the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $result = (new \yii\db\Query())
            ->select('id')
            ->from($item->data)
            ->where('user_id = ' . $user . ' AND id = ' . $params['id'])
            ->limit(1)
            ->exists();
        return $result;
    }

}