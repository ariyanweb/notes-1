<?php 
require_once 'loader.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userNumber = $_SESSION['user'];

if($userNumber!=$_GET['n_user_id']){
    header('location: panel.php');
}

if (isset($_GET['n_id']) && !empty($_GET['n_id'])) {
    $id = $_GET['n_id'];
    $delete = mysqli_query($connection, "DELETE FROM `notes` WHERE `notes`.`note_id` = '$id'");
    if ($delete) {
        $success = 'delete text successfully';
        require_once 'panel.php';
        exit;
    } else {
        $error = 'delete text failed. Please try again.';
        require_once 'panel.php';
        exit;
    }
} else {
    header('location: panel.php');
}