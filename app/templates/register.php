<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */ ?>

<h2>Регистрация</h2>

<form method="post">
    <div class="form-group">
        <label for="user_login">Логин</label>
        <input type="text" class="form-control" id="user_login" name="user_login" value="<?= $post['user_login'] ?? '' ?>" >
    </div>
    <div class="form-group">
        <label for="user_pass">Пароль</label>
        <input type="password" class="form-control" id="user_pass" name="user_pass">
    </div>
    <div class="form-group">
        <label for="user_pass2">Повторите пароль</label>
        <input type="password" class="form-control" id="user_pass2" name="user_pass2">
    </div>
    <div class="form-group">
        <label for="user_description">Описание</label>
        <input type="text" class="form-control" id="user_description" name="user_description" value="<?= $post['user_description'] ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="user_age">Возраст</label>
        <input type="number" class="form-control" id="user_age" name="user_age" min="10" max="85" value="<?= $post['user_age'] ?? '' ?>">
    </div>
    <input type="hidden" name="csrv" value="">
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
<?php if ($message): ?>
    <div class="alert alert-danger mt-3" role="alert">
        <?php foreach ($message as $m): ?>
            <p><?= $m ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>

