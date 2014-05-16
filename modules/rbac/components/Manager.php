<?php

namespace app\modules\rbac\components;

use yii\rbac\DbManager;

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

} 