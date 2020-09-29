<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */

class Controller_Logout extends Controller
{
    public function do(): void
    {
        Auth::instance()->logout();
        $this->redirect('/');
    }

}