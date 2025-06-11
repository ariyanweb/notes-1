<?php

require_once 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$check = mysqli_query($connection, "SELECT * FROM `users` WHERE `email` = '$email'");
$output = mysqli_fetch_row($check);
if (!$check || !mysqli_num_rows($check) > 0) {
    $error = 'Invalid email or password.';
    require_once 'login.php';
}

$new_password = md5($password);

if ($new_password == $output[3]) {
    $success = 'Login successful.';
    session_start();
    $_SESSION['user'] = $output[0];

    require_once 'login.php';
    header("refresh:3;url=panel.php");
    exit;
} else {
    $error = 'Invalid email or password.';
    require_once 'login.php';
    exit;
}
