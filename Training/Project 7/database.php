<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "project7";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>