<?php
extract($_POST);
include("database.php");
$firstName = $lastName = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$sql = "INSERT INTO user (FIRST_NAME, LAST_NAME, USERNAME, PASSWORD) VALUES ('$firstName', '$lastName', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php?register_success=1");
    session_start();
        $_SESSION["username"] = $username;
        $_SESSION["firstName"] = $firstName;
        $_SESSION["lastName"] = $lastName;
} else {
    header("Location: index.php?register_success=0");
}

$conn->close();
?>