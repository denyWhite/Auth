<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 *
 * Авторизация пользоватлей.
 */


class Auth
{
    /**
     * @var $instance Auth
     */
    protected static $instance;
    protected $config;
    protected $user;

    /**
     * Синглтон
     * @return Auth
     */
    public static function instance(): Auth
    {
        return self::$instance ?? self::$instance = new self();
    }

    /**
     * Загрузка конфигурации
     * @return void
     */
    public function __construct()
    {
        $this->config = Core::config('auth');
    }

    /**
     * Удаляет все токены пользователя
     * @param $user_id int ИД пользователя
     * return void
     */
    private function delete_tokens($user_id): void
    {
        Database::instance()->query(Database::DELETE, "DELETE FROM user_tokens
                                                                 WHERE user_id='$user_id'");
    }

    /**
     * Авторизация
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username, $password): bool
    {
        if (empty($password))
            return false;
        $password = $this->hash($password);
        $user = Database::instance()->query(Database::SELECT, "SELECT * FROM user_register_table
                                                                         WHERE user_login = '$username' AND user_pass = '$password'
                                                                         LIMIT 1");
        if ($user) {
            $user = $user[0];
            // Генерируем токен
            $token = $this->hash(Core::generate(16));
            // Удаляем все предыдущие токены пользователя
            $this->delete_tokens($user['id']);
            // Пишем его в базу
            Database::instance()->query(Database::INSERT, "INSERT INTO user_tokens (user_id, token)
                                                                     VALUES ('{$user['id']}', '$token')");
            // И в куки пользователю
            setcookie("user_id", $user['id'], time() + $this->config['life']);
            setcookie("token", $token, time() + $this->config['life']);
        }
        return (bool)$user;
    }

    /**
     * Возвращает текущего залогиненного пользователя
     * Возвращает NULL, если такого нет
     * @return mixed
     */
    public function get_user()
    {
        $user_id = Core::arr_get($_COOKIE, 'user_id');
        $token = Core::arr_get($_COOKIE, 'token');
        $life = $this->config['life'];
        $user = Database::instance()->query(Database::SELECT, "SELECT * FROM user_tokens AS t 
                                                                         JOIN user_register_table AS u ON t.user_id = u.id
                                                                         WHERE t.token='$token' AND t.user_id='$user_id' AND (NOW() - t.dt <= $life) 
                                                                         LIMIT 1");
        return $user ? $user[0] : NULL;

    }

    /**
     * Хеширование пароля с солью из кофнига
     * @param $str
     * @return string
     */
    public function hash($str)
    {
        return hash_hmac('sha256', $str, $this->config['salt']);
    }

    /**
     * Выход из системы
     * @return void
     */
    public function logout()
    {
        $user_id = Core::arr_get($_COOKIE, 'user_id');
        setcookie("user_id", "", time() - $this->config['life']);
        setcookie("token", "", time() - $this->config['life']);
        $this->delete_tokens($user_id);
    }

    /**
     * Проверка, есть ли пользователь в базе
     * @param $username
     * @return bool
     */
    public function is_user($username)
    {
        return (bool)Database::instance()->query(Database::SELECT, "SELECT * FROM user_register_table
                                                                         WHERE user_login = '$username'
                                                                         LIMIT 1");

    }


}