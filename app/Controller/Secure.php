<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */

class Controller_Secure extends Controller
{
    public function do():void {
        $user = Auth::instance()->get_user();
        if ( ! $user) {
            $this->redirect('/?route=login');
        }
        $users = Database::instance()->query(Database::SELECT, "SELECT * FROM user_register_table
                                                                          ORDER BY user_age");

        $last_user_count = Database::instance()->query(Database::SELECT, "SELECT COUNT(*) as count
                                                                                    FROM user_register_table
                                                                                    WHERE (NOW() - dt <= 360)");

        $this->body = View::factory('secure')
            ->set('user', $user)
            ->set('users', $users)
            ->set('last_user_count', $last_user_count ? $last_user_count[0]['count'] : 0);
    }

}