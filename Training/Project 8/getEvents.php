<?php
include("database.php");

$username = $_POST['username'];
$startMonth = $_POST['startMonth'];
$endMonth = $_POST['endMonth'];

$sql = "SELECT * FROM events WHERE USERNAME='$username' AND (START_EVENT BETWEEN '$startMonth' AND '$endMonth')";

$result = $conn->query($sql);

$appointments = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointment = new stdClass();
        $appointment->id = $row["EVENT_ID"];
        $appointment->title = $row["TITLE"];
        $appointment->startDate = $row["START_EVENT"];
        $appointment->endDate = $row["END_EVENT"];
        array_push($appointments, $appointment);
    }
}

echo json_encode($appointments);

$conn->close();

?>