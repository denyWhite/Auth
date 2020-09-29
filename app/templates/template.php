<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */ ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Тестовое задание</title>
</head>
<body>

<div class="container">
    <h1>Тестовое задание</h1>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/">Стартовая страница</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/?route=login">Авторизация</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/?route=register">Регистрация</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="/?route=secure">Защищенная страница</a>
        </li>
    </ul>
    <?= $content ?>
</div>
</body>
</html>
