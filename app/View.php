<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 *
 * Мини-шаблонизатор
 *
 */

class View
{

    private $_data = [];
    private $_file = [];

    /**
     * Фабрика
     * @param $file
     * @return View
     */
    public static function factory($file): View
    {
        return new View('templates' . DIRECTORY_SEPARATOR . $file);
    }

    /**
     * @param $file Файл шаблона
     */
    public function __construct($file)
    {
        $this->_file = $file;
    }

    /**
     * Строковое представление
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (Throwable $e) {
            return '';
        }
    }

    /**
     * Рендер шаблона
     * @return string
     */
    public function render(): string
    {
        // Выгружаем массив с данными в таблицу переменных
        extract($this->_data, EXTR_SKIP);
        // Открываем поток вывода
        ob_start();
        try {
            $fname = APPPATH . $this->_file . EXT;
            if (file_exists($fname)) {
                // @todo Проверить на существование
                include $fname;
            } else {
                throw new ErrorException('Render error');
            }
        } catch (Throwable $e) {
            ob_end_clean();
        }
        // Возвращем поток вывода
        return ob_get_clean();
    }

    /**
     * Установка переменных в шаблон
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value): View
    {
        $this->_data[$key] = $value;
        return $this;
    }


}


