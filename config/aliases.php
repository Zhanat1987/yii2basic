<?php
//Yii::setAlias('common', dirname(__DIR__));
//Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
//Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
//Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
/**
 * свои псевдонимы
 */
Yii::setAlias('cloudroot', dirname(dirname(__DIR__)) . '/web/cloud');
Yii::setAlias('cloud', 'http://' . $_SERVER["HTTP_HOST"] . '/cloud');
Yii::setAlias('mail', dirname(dirname(__DIR__)) . '/mail');