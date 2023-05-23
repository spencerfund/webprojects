<?php
extract($_POST);
include("database.php");
$title = $date = $startTime = $endTime = "";

session_start();
$username = $_SESSION["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = test_input($_POST["title"]);
    $date = test_input($_POST["date"]);
    $startTime = test_input($_POST["start-time"]);
    $endTime = test_input($_POST["end-time"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$startTime = $date . ' ' . $startTime . ':00';
$endTime = $date . ' ' . $endTime;

$sql = "INSERT INTO events (USERNAME, TITLE, START_EVENT, END_EVENT) VALUES ('$username', '$title', '$startTime', '$endTime')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php?login_success=1&add_event_success=1");
} else {
    header("Location: index.php?login_success=1&add_event_success=0");
}

$conn->close();
?>