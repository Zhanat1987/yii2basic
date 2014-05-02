<?php

namespace app\myhelpers;

/**
 * Class String
 * @package app\myhelpers
 * класс для работы со строками
 */
class String
{

    /**
     * Возвращает сумму прописью
     * @author runcore
     * @uses self::ruEnding(...)
     * http://habrahabr.ru/post/53210/
     */
    public static function num2str($num)
    {
        $nul = 'ноль';
        $ten = array(
            array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
            array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        );
        $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать',
            'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
        $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят',
            'семьдесят', 'восемьдесят', 'девяносто');
        $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот',
            'семьсот', 'восемьсот', 'девятьсот');
        $unit = array(// Units
            array('тиын', 'тиына', 'тиын', 1),
            array('тенге', 'тенге', 'тенге', 0),
            array('тысяча', 'тысячи', 'тысяч', 1),
            array('миллион', 'миллиона', 'миллионов', 0),
            array('миллиард', 'милиарда', 'миллиардов', 0),
        );
        //
        list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v))
                    continue;
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1)
                    $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3];# 20-99
                else
                    $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3];# 10-19 | 1-9
                // units without rub & kop
                if ($uk > 1)
                    $out[] = self::ruEnding($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
            } //foreach
        }
        else
            $out[] = $nul;
        $out[] = self::ruEnding(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
        //$out[] = $kop . ' ' . self::ruEnding($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }

    /**
     * Переводит первый символ в строке в верхний регистр, в т.ч.
     * для многобайтных кодировок.
     * @param string $string
     * @return string
     */
    public static function mb_ucfirst($string)
    {
        return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
    }

    /**
     * Переводит первый символ в строке в нижний регистр, в т.ч.
     * для многобайтных кодировок.
     * @param string $string
     * @return string
     */
    public static function mb_lcfirst($string)
    {
        return mb_strtolower(mb_substr($string, 0, 1)) . mb_substr($string, 1);
    }

    /**
     * Осуществить прямую (из русского в английский) транслитерацию переданной методу строки.
     */
    public static function transliterate($str)
    {
        static $lookupTable = array(
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'CSH', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '', 'Э' => 'E', 'Ю' => 'YU',
            'Я' => 'YA', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h',
            'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'csh', 'ь' => '', 'ы' => 'y', 'ъ' => '', 'э' => 'e',
            'ю' => 'yu', 'я' => 'ya',
        );
        return str_replace(array_keys($lookupTable), array_values($lookupTable), $str);
    }

    /**
     * По переданной в метод строке возвращает строку, пригодную для использования в ссылках.
     * Пример: передали "Тестовая строка 123", получили "testovaya-stroka-123".
     */
    public static function url($str)
    {
        // транслитерация строки
        $url = self::transliterate($str);

        // убираем whitespace символы на концах и переводим в нижний регистр
        $url = mb_strtolower(trim($url));

        // убираем дублирующиеся пробелы в центре строки
        for ($i = 0; $i < 10; $i++)
            $url = str_replace('  ', ' ', $url);

        // пробелы заменяем на дефисы
        $url = str_replace(' ', '-', $url);

        // оставляем только латинские цифры, буквы и дефисы
        $url = preg_replace('#[^A-Za-z0-9\-/]#ui', '', $url);

        // убираем дублирующиеся дефисы в центре строки
        for ($i = 0; $i < 10; $i++)
            $url = str_replace('--', '-', $url);

        // если в результате получилась пустая строка или строка длиной в два символа то просто
        // сгенерируем md5 хэш от оригинальной строки с примесью случайности и вернем его
//        if (!$url || mb_strlen($url) <= 2)
//            $url = mb_substr(md5($str), 0, 8) . self::random(8, 8, true, true);

        // строка для ссылки свыше 45 символов не совсем удобно
//        if (mb_strlen($url) > 45)
//            $url = mb_substr($url, 0, 40);

        return $url;
    }

    /**
     * Генерирует случайную строку.
     * @param integer $minLength минимальная длина строки
     * @param integer $maxLength максимальная длина строки
     * @param boolean $letters добавлять ли в случайную строку буквы
     * @param boolean $numbers добавлять ли в случайную строку числа
     */
    public static function random($minLength = 10, $maxLength = 20, $letters = true, $numbers = true)
    {
        // символы
        $chars = '';
        if ($letters)
            $chars.='abcdefghijklmnopqrstuvwxyz';
        if ($numbers)
            $chars.='0123456789';

        // длина
        $stringLength = mt_rand($minLength, $maxLength);

        $result = '';
        for ($i = 0; $i < $stringLength; $i++)
            $result.=$chars[mt_rand(0, mb_strlen($chars) - 1)];

        return $result;
    }

    // транслитерация
    public static function rus2translit($string)
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            ' ' => '-'
        );
        $string = strtr($string, $converter);
        $string = preg_replace("/[^a-zA-Z0-9-]/", '', $string);
        return $string;
    }

    // mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');
    public static function my_mb_ucfirst($str, $e = 'utf-8')
    {
        $fc = mb_strtoupper(mb_substr($str, 0, 1, $e), $e);
        return $fc . mb_substr($str, 1, mb_strlen($str, $e), $e);
    }

    /**
     * Возвращает 1 из 3 переданных параметров на основе анализа параметра $num.
     * Если $num попадает в группу числительных, генерирующих окончания русского
     * языка типа "1 предмет" - возвращает $v1, если "2 предмета" - $v2, если
     * "5 предметов" - $v5.
     *
     * @param int $num  число
     * @param mixed $v1 результат 1
     * @param mixed $v2 результат 2
     * @param mixed $v5 результат 5
     *
     * @return mixed
     */
    public static function ruEnding($num, $v1, $v2, $v5 = null)
    {
        $mod = $num % 10;
        $cond = floor(($num % 100) / 10) != 1;
        if ($mod == 1 && $cond) {
            return $v1;
        }
        elseif ($mod >= 2 && $mod <= 4 && $cond || $v5 === null) {
            return $v2;
        }
        else {
            return $v5;
        }
    }

}
