<?php
include("database.php");
$sql = "SELECT * FROM holidays";
$result = $conn->query($sql);

$holidays = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $holiday = new stdClass();
        $holiday->id = $row["ID"];
        $holiday->title = $row["TITLE"];
        $holiday->date = $row["START_EVENT"];
        array_push($holidays, $holiday);
    }
}

echo json_encode($holidays);

$conn->close();

?>