<?php
require_once 'config.php';
$connection = mysqli_connect($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);

function base_url(){
    global $config;
    return $config['base_url'];
}

if(!$connection){
    echo "Database connection failed: " . mysqli_connect_error();
    exit;
}

?>
