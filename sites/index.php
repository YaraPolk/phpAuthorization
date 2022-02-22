<?php
session_start();

require_once 'connection.php';

if(!empty($_SESSION['flash'])) {
    foreach($_SESSION['flash'] as $flash) {
        echo $flash;
    }

    $_SESSION['flash'] = [];
}

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)){
        $_SESSION['flash'][] = 'Welcome ' . $user['login'];
        header("Location: /");
    } else {
        echo "Sorry, incorrectly login or password. Terminal was blocked";
    }
    die();
}

echo '
    <form action="" method="POST">
        <input type="text" name="login" placeholder="Login">
        <input name="password" type="password" placeholder="Password">
        <input type="submit" value="sing in">
    </form>
';