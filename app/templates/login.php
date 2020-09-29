<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 26.06.2020
 */ ?>

<h2>Авторизация</h2>

<form method="post" >
    <div class="form-group">
        <label for="user_login">Логин</label>
        <input type="text" class="form-control" id="user_login" name="user_login" value="<?= $user_login ?>">
    </div>
    <div class="form-group">
        <label for="user_pass">Пароль</label>
        <input type="password" class="form-control" id="user_pass" name="user_pass">
    </div>
    <input type="hidden" name="csrv" value="">
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
<?php if ($message): ?>
    <div class="alert alert-danger mt-3" role="alert">
        <?= $message ?>
    </div>
<?php endif ?>
