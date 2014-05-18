<?php

use yii\db\Schema;

class m140518_093343_user_status_change extends \yii\db\Migration
{
    public function up()
    {
        $sql = 'ALTER TABLE `user` CHANGE `status` `status` TINYINT(1) NOT NULL;';
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE `user` CHANGE `status` `status` SMALLINT(6) NOT NULL DEFAULT '10';";
        $this->execute($sql);
    }
}
