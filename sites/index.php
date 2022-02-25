<?php

if (!empty($_POST['sing_in'])){
    header("Location: /login.php");
}

if (!empty($_POST['sing_up'])){
    header("Location: /new.php");
}

echo '
    <form action="" method="post">
        <input type="submit" value="sing in" name="sing_in">
        <input type="submit" value="sing up" name="sing_up">
    </form>
';