<?php
session_start();

require_once 'connection.php';

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE login = '$login'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)){
        echo 'This login already exists';
    } else {
        $query = "INSERT INTO users SET login = '$login', password = '$password'";
        $result = mysqli_query($connection, $query);
        $_SESSION['flash'] = 'Welcome ' . $login;
        $_SESSION['auth'] = true;
        $id = mysqli_insert_id($connection);
        $_SESSION['id'] = $id;
        header("location: /page.php");
    }
}

echo '
    <form action="" method="POST">
        <input name="login" type="text" placeholder="Login">
        <input name="password" type="password" placeholder="Password">
        <input type="submit" name="create" value="create">
    </form>
';
