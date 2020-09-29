<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 *
 * работа с базой данных MySQL
 *
 */

class Database
{
    public const SELECT = 1;
    public const INSERT = 2;
    public const UPDATE = 3;
    public const DELETE = 4;

    protected static $instance;

    /**
     * Синглтон
     * @return Database
     */
    public static function instance(): Database
    {
        return self::$instance ?? self::$instance = new self();
    }

    /**
     * Соединение с базой
     * @return void
     */
    public function connect(): void
    {
        $config = Core::config('database');
        if (!$this->_connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database'])) {
            // @todo Обработка ошибок
            $this->_connection = NULL;
        }
    }

    /**
     * Закрытие соединения
     * @return bool
     */
    public function disconnect(): bool
    {
        if (!isset($this->_connection)) {
            return false;
        }
        if ($status = mysqli_close($this->_connection)) {
            $this->_connection = NULL;
        }
        return $status;
    }

    /**
     * Запрос к базе
     * @param $type int тип запроса
     * @param $sql string запрос
     * @return array|bool
     */
    public function query($type, $sql)
    {
        if (!isset($this->_connection)) {
            $this->connect();
        }
        if (!$result = mysqli_query($this->_connection, $sql)) {
            // @todo Обработка ошибок
            die(mysqli_error($this->_connection));
        }
        if ($type === self::SELECT) {
            if (!$result) {
                return false;
            }
            $ret = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $ret[] = $row;
            }
            mysqli_free_result($result);
            return $ret;
        } elseif ($type === self::INSERT) {
            return [
                $this->_connection->insert_id,
                $this->_connection->affected_rows,
            ];
        } else {
            return $this->_connection->affected_rows;
        }
    }


}