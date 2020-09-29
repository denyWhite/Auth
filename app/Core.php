<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 *
 * Вспомогательные функции
 *
 */

class Core
{
    /**
     * Фильрация ввода
     * @param $str
     * @return string
     */
    public static function strips($str): string
    {
        // @todo Сделать валидацию ввода
        return strip_tags(trim($str));
    }

    /**
     * Элемент массива по индексу с фильтрацей
     * @param $array
     * @param $key
     * @param null $default
     * @return string
     */
    public static function arr_get($array, $key, $default = NULL): string
    {
        return self::strips($array[$key] ?? $default);
    }

    /**
     * Элементы массива по массиву индексов с фильтрацией
     * @param $array
     * @param array $paths
     * @param null $default
     * @return array
     */
    public static function arr_extract($array, array $paths, $default = NULL): array
    {
        $found = [];
        foreach ($paths as $path) {
            $found[$path] = self::strips($array[$path] ?? $default);
        }
        return $found;
    }

    /**
     * Загрузка конфигураций из файлов
     * @param $fname
     * @return array
     */
    public static function config($fname): array
    {
        // @todo проверить существование
        return include APPPATH . 'config' . DIRECTORY_SEPARATOR . $fname . EXT;
    }

    /**
     * Генерация случайной строки
     * @param int $length
     * @return string
     */
    public static function generate($length = 16): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';
        $code = '';
        $len = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $len)];
        }
        return $code;
    }


}