<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 *
 * Валидация данных
 *
 */

class Validate
{

    /**
     * Является ли числом без знака
     * @param $var
     * @return bool
     */
    public static function is_number($var): bool
    {
        return preg_match('/^\d+$/', $var);
    }

    /**
     * Равны ли значения
     * @param $var
     * @param $var2
     * @return bool
     */
    public static function is_equal($var, $var2): bool
    {
        return $var === $var2;
    }

    /**
     * Пуста ли переменная
     * @param $var
     * @return bool
     */
    public static function is_empty($var): bool
    {
        return empty($var);
    }


    /**
     * Явялется ли строкой
     * @param $var
     * @return bool
     */
    public static function is_string($var): bool
    {
        return (bool)preg_match('/^[a-zA-Z]+$/', $var);
    }


    /**
     * Может ли быть паролем
     * @param $var
     * @return bool
     */
    public static function is_password($var): bool
    {
        // Не меньше 7 символов
        if (strlen($var) < 7) {
            return false;
        }

        // Содержит символ
        if (!preg_match('/[a-zA-Z]/', $var)) {
            return false;
        }

        // Содержит цифру
        if (!preg_match('/\d/', $var)) {
            return false;
        }

        // Содержит спесимвол из списка
        if (!preg_match('/[.,?!@#$%^&*()\-+]/', $var)) {
            return false;
        }
        return true;
    }


}