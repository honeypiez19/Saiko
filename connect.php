<?php
// connect
$servername = "192.168.100.122";
$username = "samt";
$password = "samtadmin12";
$db = "test_saiko";
$port = "3306";

$conn = new mysqli($servername, $username, $password, $db,$port);
if (!$conn)
    die("Connection error: ". $conn->connect_error);
    
?>