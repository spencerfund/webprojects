<?php
extract($_POST);
include("database.php");
$title = $date = $startTime = $endTime = "";

session_start();
$username = $_SESSION["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = test_input($_POST["title"]);
    $date = test_input($_POST["date"]);
    $startTime = test_input($_POST["startTime"]);
    $endTime = test_input($_POST["endTime"]);
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
    http_response_code(200);
    echo json_encode(array("message" => "Event added successfully"));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "There was an error processing the request"));
}

$conn->close();
?>