<?php

namespace app\myhelpers;

/**
 * Class Debugger
 * @package app\myhelpers
 * класс-отладчик кода
 */
class Debugger
{

    public function debug($v)
    {
        echo '<pre style="background-color: #000; color: #fff; font-size: 14px;
                    font-weight: 600; line-height: 18px; margin: 20px;
                    padding: 20px; border: 3px solid #00FF40;  border-radius: 10px;">';
        var_dump($v);
        echo '</pre>';
    }

    public function stop($v)
    {
        exit(self::debug($v));
    }

    public function margin()
    {
        echo '<br /><br /><br /><br /><br />';
    }

    /**
     * @param $e
     * TODO
     * уведомление по e-mail для администратора
     */
    public function exception($e, $return)
    {
        if (!($e instanceof \Exception)) {
            return;
        }
        if (\Yii::$app->session->get('role') == 'супер-администратор') {
            echo '<div style="background-color: black; color: #fff;
                font-size: 14px; font-weight: 600; line-height: 18px; max-width: 1000px;
                overflow-wrap: normal; word-wrap: normal; word-break: normal;
                line-break: auto; hyphens: manual;">';
            $eInfo = 'message - ' . $e->getMessage()
                . '<br />code - ' . $e->getCode()
                . '<br />file - ' . $e->getFile()
                . '<br />line - ' . $e->getLine()
                . '<br />trace - ' . $e->getTraceAsString();
            var_dump($eInfo);
            echo '</div>';
            exit;
        }
        switch ($return) {
            case 'continue' :
                return;
                break;
        }
    }

} 