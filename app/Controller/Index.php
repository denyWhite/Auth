<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */

class Controller_Index extends Controller
{
    public function do(): void
    {
        $this->body = View::factory('index');
    }

}