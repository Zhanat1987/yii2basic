<?php

namespace app\myhelpers;

/**
 * Class RestHelper
 * @package app\myhelpers
 * дополнительные функции
 */
class Rest
{

    // очистка данных пришедших через jquery ajax
    public static function ajaxClear($v)
    {
        return trim(urldecode($v));
    }

    // проверить данные на целое число
    public static function isInt($v)
    {
        $v = trim($v);
        if (!empty($v)) {
            if (strpos($v, '.') === false && strpos($v, ',') === false) {
                if ($v === 0 || $v > 0) {
                    return true;
                }
            }
        } else {
            return true;
        }
        return false;
    }

    // перевести данные в массив
    public static function dataToConfig($v)
    {
        return explode(',', rtrim(urldecode($v), ','));
    }

    // функция для отправки сооб-я в utf-8
    public static function mail_utf8($to, $from, $subject, $message)
    {
        $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=utf-8\r\n";
        $headers .= "From: $from\r\n";

        return mail($to, $subject, $message, $headers);
    }

    // нативная сорт-ка по ключам массива
    public static function knatsort(&$array)
    {
        $array_keys = array_keys($array);
        natsort($array_keys);
        $new_natsorted_array = array();
        $array_keys_2 = '';
        foreach ($array_keys as $array_keys_2) {
            $new_natsorted_array[$array_keys_2] = $array[$array_keys_2];
        }
        $array = $new_natsorted_array;
        return true;
    }

    // подсказки
    public static function hintReplace($v)
    {
        $pattern = '/\s|\.|,|-|"|\>|\</';
        $hints = Hint::getAll();
        foreach ($hints as $hint) {
            $k = 0;
            if (mb_stripos($v, $hint["q"]) !== false) {
                $words = preg_split($pattern, $v, 0, PREG_SPLIT_OFFSET_CAPTURE);
                foreach ($words as $word) {
                    if (mb_strtolower($word[0]) == mb_strtolower($hint["q"])) {
                        $img = '<a href="#" title="' . $hint["hint"] .
                            '" class="replaceTooltip" ><img src="/css/images/q.png" /></a>';
                        $v = substr_replace($v, $word[0] . $img, $word[1] + $k, strlen($word[0]));
                        $k += strlen($img);
                    }
                }
            }
        }
        echo $v;
    }

    /**
     * случайное число с плавающей точкой
     * округление до сотых
     */
    public static function randomFloat($min, $max)
    {
        return round($min + lcg_value() * (abs($max - $min)), 2);
    }

}
