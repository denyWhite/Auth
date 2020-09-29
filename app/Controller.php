<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 *
 *
 * Базовый класс для контроллеров
 *
 */

abstract class Controller
{

    /**
     * @var $body string
     */
    public $template = 'template';
    public $body;

    /**
     * Фабрика классов
     * @param $route
     * @return Controller
     */
    public static function factory($route): Controller
    {
        $class_name = 'Controller_' . ucfirst($route);
        return new $class_name($route);
    }

    /**
     * Действие в контроллере
     * @return Controller $this
     */
    public function execute(): Controller
    {
        $this->do();
        return $this;
    }

    /**
     * Формирование тела ответа
     * @return View
     */
    public function body(): View
    {
        return View::factory($this->template)
            ->set('content', $this->body);

    }

    /**
     * Редирект
     * @param $url
     * @return void
     */
    public function redirect($url): void
    {
        header("Location: $url");
        exit();
    }


}