<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 *
 * Роутинг приложения
 *
 */

class Route
{
    private static $routes = ['index', 'register', 'login', 'secure', 'logout'];

    /**
     * Проверяет есть ли в URL валидный роут
     * Если есть, то возврщает его
     * Если нет, возвращает null
     * @return string | null
     */
    public static function get(): string
    {
        $route = Core::arr_get($_GET, 'route', 'index');
        return in_array($route, self::$routes, true) ? $route : null;
    }

}