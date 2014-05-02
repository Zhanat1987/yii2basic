<?php

namespace app\myhelpers;

/**
 * Class FileAndDir
 * @package app\myhelpers
 * класс для работы с файлами и директориями
 */
class FileAndDir
{

    // возвр-т расш-е файла
    public static function getFileExt($file)
    {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }

    // нормализовать массив $_FILES
    public static function getNormalizedFILES()
    {
        $newfiles = array();
        foreach ($_FILES as $fieldname => $fieldvalue)
            foreach ($fieldvalue as $paramname => $paramvalue)
                foreach ((array) $paramvalue as $index => $value)
                    $newfiles[$fieldname][$index][$paramname] = $value;
        return $newfiles;
    }

    // удалить все файлы из директории
    public static function cleanDirectory($dir)
    {
        if ($objs = glob($dir . "/*")) {
            foreach ($objs as $obj) {
                unlink($obj);
            }
        }
    }

    // удалить все файлы из директории и саму директорию
    public static function removeDirRec($dir)
    {
        if ($objs = glob($dir . "/*")) {
            foreach ($objs as $obj) {
                unlink($obj);
            }
        }
        if (is_dir($dir)) {
            rmdir($dir);
        }
    }

    // удалить все файлы и папки из директории и саму директорию
    public static function removeDir($path, $del = true)
    {
        if (file_exists($path) && is_dir($path)) {
            $dirHandle = opendir($path);
            while (false !== ($file = readdir($dirHandle))) {
                if ($file != '.' && $file != '..') {// исключаем папки с назварием '.' и '..'
                    $tmpPath = $path . '/' . $file;
                    chmod($tmpPath, 0777);

                    if (is_dir($tmpPath)) {  // если папка
                        self::removeDir($tmpPath);
                    }
                    else {
                        if (file_exists($tmpPath)) {
                            // удаляем файл
                            unlink($tmpPath);
                        }
                    }
                }
            }
            closedir($dirHandle);

            // удаляем текущую папку
            if (file_exists($path) && $del) {
                rmdir($path);
            }
        }
        else {
            echo "Удаляемой папки не существует или это файл!";
        }
    }

    /*
     * проверка существования внешнего файла
     * http://habrahabr.ru/post/50846/
     */
    public static function outerFileExists($url)
    {
        $headers = @get_headers($url);
        // проверяем ли ответ от сервера с кодом 200 - ОК
        if (strpos($headers[0], '200') !== FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
