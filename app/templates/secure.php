<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */ ?>

    <h2>Защищенная страница</h2>
    <p class="text-right">Вы вошли, как <?= $user['user_login'] ?>, <a href="/?route=logout">выйти</a></p>

    <p>Зарегистрировано пользователей за последние 6 минут: <?= $last_user_count ?></p>

    <h3>Пользователи</h3>
<?php if ($users): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Логин</th>
            <th>Возраст</th>
            <th>Описание</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['user_login'] ?></td>
                <td><?= $user['user_age'] ?></td>
                <td><?= $user['user_description'] ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Нет пользователей</p>
<?php endif ?>