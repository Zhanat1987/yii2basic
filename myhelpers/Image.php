<?php

namespace app\myhelpers;

/**
 * Class ImageHelper
 * @package app\myhelpers
 * класс для работы с изображениями
 */
class Image
{

    // проверка файла на валидное изображение
    public static function validImage($ext, $size)
    {
        $validFormats = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $validFormats) && ($size > 0 && $size <= 1048576)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // сохранить изображение с помощью curl из https
    public static function saveImageFromHttpsWithCurl($url, $image)
    {
        $ch = curl_init($url);
        $fp = fopen($image, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        $response = curl_exec($ch);
        curl_close($ch);
        fwrite($fp, $response);
        fclose($fp);
    }

    // проверить валидность расширения изображения
    public static function validImgFormat($v)
    {
        return in_array($v, array('jpg', 'jpeg', 'png', 'gif')) ? $v : '';
    }

}
