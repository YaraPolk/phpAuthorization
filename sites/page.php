<?php
session_start();

require_once 'connection.php';

if (!empty($_POST['logout'])) {
    unset($_SESSION['auth'], $_SESSION['flash'], $_SESSION['id']);
    header("Location: /" );
}

if (!empty($_POST['edit'])) {
    header("Location: /edit_user.php" );
}

if (!empty($_POST['admin'])) {
    header("Location: /admin.php" );
}

if (!empty($_POST['delete'])) {
    header("Location: /delete.php" );
}

if(!empty($_SESSION['flash'])) {
    echo $_SESSION['flash'];
}

echo "<br />";
if(!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    $user_id = mysqli_fetch_assoc($result);

    if (!empty($user_id)){
        echo $user_id['login'];
    }

    if ($user_id['roles'] === 'admin'){
        echo '<br />';
        echo '
            <p>You can control users accounts</p>
            <form action="" method="post">
                <input type="submit" name="admin" value="account list">
            </form>
        ';
    }
}
echo '<br />';
echo ' This page is for authorized users only!';
echo '<br />';
echo '
    <p>You can change your login here</p>
    <form action="" method="post">
        <input type="submit" name="edit" value="edit">
    </form>
';
echo '<br />';
echo '
    <p>You can delete your account</p>
    <form action="" method="post">
        <input type="submit" name="delete" value="delete">
    </form>
';
echo '<br />';
echo '
    <form action="" method="post">
        <input type="submit" name="logout" value="logout">
    </form>
';
