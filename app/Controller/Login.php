<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */

class Controller_Login extends Controller
{
    public function do(): void
    {
        if (count($_POST)) {
            $post = Core::arr_extract($_POST, ['user_login', 'user_pass', 'csrf']);
            if (Auth::instance()->login($post['user_login'], $post['user_pass'])) {
                $this->redirect('/?route=secure');
            } else {
                $message = 'Пользователь с данным user_login или паролем не зарегистрирован, <a href="/?route=register">пройдите регистрацию</a>';
            }
        }
        $this->body = View::factory('login')
            ->set('message', $message ?? '')
            ->set('user_login', $post['user_login'] ?? '');
    }
}