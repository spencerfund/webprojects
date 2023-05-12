<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php 
$firstName = $lastName = $email = $phone = $address = $city = $zipCode = $state = $gender = $schoolYear = "";
$usCitizen = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $address = test_input($_POST["address"]);
    $city = test_input($_POST["city"]);
    $zipCode = test_input($_POST["zipCode"]);
    $state = test_input($_POST["state"]);
    $gender = test_input($_POST["gender"]);
    $schoolYear = test_input($_POST["schoolYear"]);
    if (isset($_POST["usCitizen"])) {
        $usCitizen = true;
    } else {
        $usCitizen = false;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
echo "<div class=\"break\"></div><div class=\"form_holder\"><h4>Personal Information</h4>";
echo "Name: " . $firstName . " " . $lastName;
echo "<br>";
echo "Gender: " . $gender;
echo "<br>";
echo "Year in School: " . $schoolYear;
echo "<br>";

if ($usCitizen == true) {
    echo "US Citizen: Yes";
} else {
    echo "US Citizen: No";
}


echo "<h4>Contact Information:</h4>";
echo "Email: " . $email;
echo "<br>";
echo "Phone: " . $phone;
echo "<div class=\"break\"></div>";
echo "<h4>Address</h4>" . $address;
echo "<br>";
echo $city . ", " . $state . " " . $zipCode;
echo "</div>";
?>
    
</body>
</html>