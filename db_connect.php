<?php
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    // xampp
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "3aparone";
} else {
    // infinityfree
    $host = "://infinityfree.com";
    $username = "if0_42844781";
    $password = "CGPgHtY8k8N";
    $db_name = "if0_42844781_db_3APARONE";
}

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
