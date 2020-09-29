<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */


class Controller_Register extends Controller
{
    public function do(): void
    {
        if (count($_POST)) {
            unset($message);
            $post = Core::arr_extract($_POST, ['user_login', 'user_pass', 'user_pass2', 'user_description', 'user_age']);

            // Валидация
            if (Validate::is_empty($post['user_login'])) {
                $message[] = 'Имя пользователя не должно быть пустым';
            }

            if (!Validate::is_string($post['user_login'])) {
                $message[] = 'Имя пользователя должно состоять только из символов';
            }

            if (Auth::instance()->is_user($post['user_login'])) {
                $message[] = 'Такой пользователь уже есть';
            }

            if (Validate::is_empty($post['user_pass'])) {
                $message[] = 'Нужно указать пароль';
            }

            if (!Validate::is_equal($post['user_pass'], $post['user_pass2'])) {
                $message[] = 'Пароли не совпадают';
            }

            if (!Validate::is_password($post['user_pass'])) {
                $message[] = 'Длина пароля должна быть более 7 символов и содержать символы, цифры и спецсимволы';
            }

            if (!Validate::is_number($post['user_age']) || $post['user_age'] < 10 || $post['user_age'] > 85) {
                $message[] = 'Возвраст должен быть между 10 и 85 годами';
            }

            if (!isset($message)) {
                // Сохраняем
                $post['user_pass'] = Auth::instance()->hash($post['user_pass']);
                unset($post['user_pass2']);
                $keys = implode(',', array_keys($post));
                $values = implode(',', array_map(static function ($rec) {
                    return "'" . $rec . "'";
                }, $post));
                Database::instance()->query(Database::INSERT, "INSERT INTO user_register_table ($keys)
                                                  VALUES ($values)");
                $message[] = 'Данные успешно сохранены';
            }
        }

        $this->body = View::factory('register')
            ->set('message', $message ?? false)
            ->set('post', $post ?? []);
    }

}