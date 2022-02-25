<?php
session_start();

require_once 'connection.php';

$id = $_SESSION['id'];

if(!empty($_POST['delete'])){

    $query = "DELETE FROM users WHERE id='$id'";
    mysqli_query($connection, $query);
    $_SESSION['delete'] = "Your account has been deleted";
    header("Location: /");
} else {
    echo "This password is not correct";
}
?>

<form action="" method="post">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="delete" value="delete">
</form>
