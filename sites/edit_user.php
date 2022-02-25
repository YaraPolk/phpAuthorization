<?php
session_start();

require_once 'connection.php';

$id = $_SESSION['id'];

if (!empty($_POST['logout'])) {
    unset($_SESSION['auth'], $_SESSION['flash'], $_SESSION['id']);
    header("Location: /" );
}

if (!empty($_SESSION['editLogin'])){
    echo $_SESSION['editLogin'];
    unset($_SESSION['editLogin']);
}

if(!empty($_POST['edit'])){
    $newLogin = $_POST['newLogin'];

    $query = "SELECT * FROM users WHERE login = '$newLogin'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)){
        echo "Sorry this login is already in use";
    } else {
        $query = "UPDATE users SET login = '$newLogin' WHERE id = '$id'";
        mysqli_query($connection, $query);

        $_SESSION['editLogin'] = 'Your new login has been updated';
        header("Location: /edit_user.php");
    }
}
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);
echo $user['login'];
?>

<form action="" method="post">
    <input type="text" name="newLogin" value="<?= $user['login']?>">
    <input type="submit" name="edit" value="edit">
</form>
<form action="" method="post">
    <input type="submit" name="logout" value="logout">
</form>