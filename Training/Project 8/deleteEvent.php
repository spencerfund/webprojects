<?php
include("database.php");

$title = $_POST['title'];

$sql = "DELETE FROM events WHERE `events`.`TITLE` = '$title'";

if ($conn->query($sql) === TRUE) {
    http_response_code(200);
    echo json_encode(array("message" => "Event deleted successfully"));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "There was an error processing the request. Requested Title: $title"));
}

$conn->close();

?>