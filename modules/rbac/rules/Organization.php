<?php

namespace app\modules\rbac\rules;

use yii\rbac\Rule;

/**
 * проверяет организацию, создавшую запись или организацию,
 * которой предназначается запись для просмотра
 */
class Organization extends Rule
{

    public $name = 'Организация';

    public function execute($user, $item, $params)
    {
        list($table, $field) = explode(',', $item->data);
        $where['id'] = $params['id'];
        $where[$field] = $user;
        $result = (new \yii\db\Query())
            ->select('id')
            ->from($table)
            ->where($where)
            ->limit(1)
            ->exists();
        return $result;
    }

}