<?php

session_start();

$url = $_SERVER['REQUEST_URI'];

require_once '../connection.php';


if (!empty($_POST['logout'])) {
    unset($_SESSION['auth'], $_SESSION['flash'], $_SESSION['id']);
    header("Location: /" );
}

if (!empty($_SESSION['flash'])) {
    echo $_SESSION['flash'];
    unset($_SESSION['flash']);
}

if (!empty($_POST['edit'])) {
    $id = $_GET['edit'];
    $newLogin = $_POST['newLogin'];
    $newRole = $_POST['newRole'];

    $query = "SELECT * FROM users WHERE login = '$newLogin'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {
        $_SESSION['flash'] = "Sorry this login is already in use";
        header("Location: /admin/admin.php");
    } else {
        $query = "UPDATE users SET login = '$newLogin', roles = '$newRole' WHERE id = '$id'";
        mysqli_query($connection, $query);
        $_SESSION['flash'] = 'Login has been updated';
        header("Location: /admin.php");
    }
}

if (!empty($_GET['del'])){
    $id = $_GET['del'];

    $query = "DELETE FROM users WHERE id='$id'";
    mysqli_query($connection, $query) or die(mysqli_error($connection));

    $_SESSION['flash'] = "Account has been deleted";
    header("Location: /admin//admin.php");
}

if (!empty($_GET['edit'])){
    $id = $_GET['edit'];

    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $user = mysqli_fetch_assoc($result);

    echo '
        <form action="" method="post">
            <input type="text" name="newLogin" value="' . $user['login'] . '">
            <select name="newRole">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="edit" value="edit">
        </form>
        <br />
        <br />
    ';
}

$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

echo $url;

for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All users from DB</title>
</head>

<body>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>login</th>
        <th>role</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['login'] ?></td>
            <td><?= $value['roles'] ?></td>
            <td><a href="admin.php?edit=<?= $value['id'] ?>">edit</a></td>
            <td><a href="admin.php?del=<?= $value['id'] ?>">delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<form action="" method="post">
    <input type="submit" name="logout" value="logout">
</form>
</body>
</html>