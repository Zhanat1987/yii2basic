<?php

namespace app\myhelpers;

/**
 * Class DateAndTime
 * @package app\myhelpers
 * класс для работы с датой и временем
 */
class DateAndTime
{

    // русская дата
    public static function ruDate($date)
    {
        $months = array('01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
            '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
            '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря');
        $day = ltrim(substr($date, 8, 2), '0');
        $month = $months[substr($date, 5, 2)];
        $year = substr($date, 0, 4);
        $ruDate = $day . ' ' . $month . ' ' . $year;
        return $ruDate;
    }

    // русская дата 2
    public static function ruDate2($date)
    {
        $months = array('01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
            '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
            '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря');
        $day = ltrim(substr($date, 8, 2), '0');
        $month = $months[substr($date, 5, 2)];
        $ruDate = $day . ' ' . $month;
        return $ruDate;
    }

    // дата в формате datetime = 'yyyy-mm-dd'
    public static function datetime($date)
    {
        $date = substr($date, 0, 10);
        return $date;
    }

}
