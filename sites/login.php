<?php
session_start();

require_once 'connection.php';

if(!empty($_SESSION['auth'])) {
    header("Location: /page.php");
}

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE login = '$login'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)){
        $userHash = $user['password'];

        if(password_verify($_POST['password'], $userHash)){
            $_SESSION['flash'] = 'Welcome ' . $user['login'];
            $_SESSION['auth'] = true;
            $id = $user['id'];
            $_SESSION['id'] = $id;
            if ($user['roles'] === 'admin'){
                header("Location: /admin.php");
            } else {
                header("Location: /page.php");
            }
        } else {
            echo "Sorry, incorrectly password. Terminal was blocked";
        }
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