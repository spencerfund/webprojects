<?php
extract($_POST);
include("database.php");
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$sql = "SELECT * FROM user WHERE USERNAME='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row["PASSWORD"] == $password) {
        header("Location: index.php?login_success=1");
        session_start();
        $_SESSION["username"] = $row["USERNAME"];
        $_SESSION["firstName"] = $row["FIRST_NAME"];
        $_SESSION["lastName"] = $row["LAST_NAME"];
    } else {
        header("Location: index.php?login_success=0");
    }
} else {
    header("Location: index.php?login_success=0");
}

$conn->close();
?>