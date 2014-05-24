<?php

namespace app\modules\rbac\components;

use yii\rbac\DbManager;
use yii\db\Query;
use yii\rbac\Assignment;
use yii\rbac\Item;

class Manager extends DbManager
{

    public function getRole($name)
    {
        /**
         * в методе assign(), при назначении роли,
         * у объекта $role запрашивается свойство 'name'
         * поэтому создается экземпляр класса StdClass
         * и своуству 'name' присваивается значение текущей роли пользователя
         */
        $role = new \StdClass();
        $role->name = $name;
        return $role;
    }

    /**
     * @inheritdoc
     */
    public function getRolesByUser($userId)
    {
        $query = (new Query)->select('b.*')
            ->from(['a' => $this->assignmentTable, 'b' => $this->itemTable])
            ->where('a.item_name=b.name')
            ->andWhere(['a.organization_id' => $userId]);

        $roles = [];
        foreach ($query->all($this->db) as $row) {
            $roles[$row['name']] = $this->populateItem($row);
        }
        return $roles;
    }

    /**
     * @inheritdoc
     */
    public function getPermissionsByUser($userId)
    {
        $query = (new Query)->select('item_name')
            ->from($this->assignmentTable)
            ->where(['organization_id' => $userId]);

        $childrenList = $this->getChildrenList();
        $result = [];
        foreach ($query->column($this->db) as $roleName) {
            $this->getChildrenRecursive($roleName, $childrenList, $result);
        }

        if (empty($result)) {
            return [];
        }

        $query = (new Query)->from($this->itemTable)->where([
            'type' => Item::TYPE_PERMISSION,
            'name' => array_keys($result),
        ]);
        $permissions = [];
        foreach ($query->all($this->db) as $row) {
            $permissions[$row['name']] = $this->populateItem($row);
        }
        return $permissions;
    }

    /**
     * @inheritdoc
     */
    public function getAssignment($roleName, $userId)
    {
        $row = (new Query)->from($this->assignmentTable)
            ->where(['organization_id' => $userId, 'item_name' => $roleName])
            ->one($this->db);

        if ($row === false) {
            return null;
        }

        if (!isset($row['data']) || ($data = @unserialize($row['data'])) === false) {
            $data = null;
        }

        return new Assignment([
            'userId' => $row['organization_id'],
            'roleName' => $row['item_name'],
            'createdAt' => $row['created_at'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getAssignments($userId)
    {
        $query = (new Query)
            ->from($this->assignmentTable)
            ->where(['organization_id' => $userId]);

        $assignments = [];
        foreach ($query->all($this->db) as $row) {
            if (!isset($row['data']) || ($data = @unserialize($row['data'])) === false) {
                $data = null;
            }
            $assignments[$row['item_name']] = new Assignment([
                'userId' => $row['organization_id'],
                'roleName' => $row['item_name'],
                'createdAt' => $row['created_at'],
            ]);
        }

        return $assignments;
    }

    /**
     * @inheritdoc
     */
    public function assign($role, $userId, $rule = null, $data = null)
    {
        $assignment = new Assignment([
            'userId' => $userId,
            'roleName' => $role->name,
            'createdAt' => time(),
        ]);

        $this->db->createCommand()
            ->insert($this->assignmentTable, [
                'organization_id' => $assignment->userId,
                'item_name' => $assignment->roleName,
                'created_at' => $assignment->createdAt,
            ])->execute();

        return $assignment;
    }

    /**
     * @inheritdoc
     */
    public function revoke($role, $userId)
    {
        return $this->db->createCommand()
            ->delete($this->assignmentTable, ['organization_id' => $userId, 'item_name' => $role->name])
            ->execute() > 0;
    }

    /**
     * @inheritdoc
     */
    public function revokeAll($userId)
    {
        return $this->db->createCommand()
            ->delete($this->assignmentTable, ['organization_id' => $userId])
            ->execute() > 0;
    }

} 