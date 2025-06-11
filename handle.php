<?php

if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    if ($type == 'register') {
        require_once 'inc/register.php';
    } else if ($type == 'login') {
        require_once 'inc/login.php';
    } else {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}

?>