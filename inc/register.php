<?php
require_once 'db.php';

$name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
$email = $_POST['email'];
$pass = $_POST['password'];
$pass2 = $_POST['confrimpass'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email address.';
    require_once 'index.php';
    exit;
}

if (empty($email)) {
    $error = 'Please enter your email address.';
    require_once 'index.php';
    exit;
}

if (empty($pass) || empty($pass2)) {
    $error = 'Please enter and confirm your password.';
    require_once 'index.php';
    exit;
}

if ($pass != $pass2) {
    $error = 'Passwords do not match.';
    require_once 'index.php';
    exit;
}

if (strlen($pass) <= 3) {
    $error = 'Password must be longer than 3 characters.';
    require_once 'index.php';
    exit;
}

$check = mysqli_query($connection, "SELECT * FROM `users` WHERE `email` = '$email'");
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        $error = 'Email is already registered.';
        require_once 'index.php';
        exit;
    }
}

$password = md5($pass2);

$insert = mysqli_query($connection, "INSERT INTO `users` (`name`,`email`,`password`) VALUES ('$name','$email','$password')");

if ($insert) {
    $success = 'registered successfully';
    require_once 'index.php';
    exit;
} else {
    $error = 'Registration failed. Please try again.';
    require_once 'index.php';
    exit;
}
