<?php
session_start();

$url = $_SERVER['REQUEST_URI'];

$layout = file_get_contents('layout.php');
$content = file_get_contents('view' . $url . '.php');
$titles = require 'title.php';

$title = $titles[$url];

$layout = str_replace('{{ title }}', $title, $layout);
$result = str_replace('{{ content }}', $content, $layout);

echo $result;

if (!empty($_POST['sing_in'])){
    header("Location: /login.php");
}

if (!empty($_POST['sing_up'])){
    header("Location: /new.php");
}

if(!empty($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

echo '
    <form action="" method="post">
        <input type="submit" value="sing in" name="sing_in">
        <input type="submit" value="sing up" name="sing_up">
    </form>
';