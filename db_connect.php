<?php
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
    // for XAMPP
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "3aparone";

} else {
    
    // for INFINITYFREE
    $host = "sql202.infinityfree.com";
    $username = "if0_42844781";
    $password = "CGPgHtY8k8N";
    $db_name = "if0_42844781_db_3aparone";
}


$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
