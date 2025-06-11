<?php
require_once 'loader.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userNumber = $_SESSION['user'];

if (isset($_POST['add'])) {
    $conntent = $_POST['content'];
    $title = $_POST['title'];
    if (empty($_FILES['file'])) {

    $insert = mysqli_query($connection, "INSERT INTO `notes` (`note_title`,`note_content`,`user_id`) VALUES ('$title','$conntent','$userNumber')");
        if ($insert) {
        $success = 'Added text successfully';
        require_once 'panel.php';
        exit;
    } else {
        $error = 'Added text failed. Please try again.';
        require_once 'panel.php';
        exit;
    }
    }
    if (isset($_FILES['file']) && !empty($_FILES['file'])) {
        $tempFile = $_FILES['file']['tmp_name'];
        $folder = 'uploads/';
        $new_name = 'file_' . time() . '.png';
        $status = move_uploaded_file($tempFile, $folder . $new_name);

        $insert = mysqli_query($connection, "INSERT INTO `notes` (`note_title`,`note_content`,`user_id`,`note-file-name`) VALUES ('$title','$conntent','$userNumber','$new_name')");
    
    if ($insert) {
        $success = 'Added text successfully';
        require_once 'panel.php';
        exit;
    } else {
        $error = 'Added text failed. Please try again.';
        require_once 'panel.php';
        exit;
    }
}} else {
    header('location: panel.php');
}


if (isset($_POST['add-update'])) {
    require_once 'loader.php';
    $conntentu = $_POST['contentu'];
    $titleu = $_POST['titleu'];
    $id = $_POST['noteID'];
    $update = mysqli_query($connection, "UPDATE `notes` SET `note_title`= '$titleu',`note_content`= '$conntentu' WHERE `notes`.`note_id` = '$id'");
    if ($update) {
        $success = 'update text successfully';
    header('location: panel.php');
    } else {
        $error = 'update text failed. Please try again.';
        header('location: panel.php');
    }
}else {
    header('location: panel.php');
}

