<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */

error_reporting(E_ALL & ~E_NOTICE);

$app = 'app';
define('APPPATH', realpath($app) . DIRECTORY_SEPARATOR);
unset($app);

define('EXT', '.php');

date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU.utf-8');

// Регистрируем автолоадер классов
spl_autoload_register(function ($class) {
    $class = str_replace('_', DIRECTORY_SEPARATOR, $class);
    $fname = APPPATH . $class . EXT;
    if (file_exists($fname)) {
        include $fname;
    }
});

// Проверям валидность роута
if (!$route = Route::get()) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// Загружаем соответствующий роуту контроллер
echo Controller::factory($route)
    ->execute()
    ->body();

// Если нужно закрываем мсоединение с базой
Database::instance()->disconnect();