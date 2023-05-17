<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Photo Gallery</h1>
        <div class="account">
            <?php
            session_start();
            $firstName = $_SESSION["firstName"];
            $lastName = $_SESSION["lastName"];
            echo "<p id=\"user\">" . $firstName . " " . $lastName . "</p>";
            ?>
            <button onclick="location.href='logout.php'">Log Out</button>
        </div>
    </div>
    <div class="form_holder">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="upload-photo">Upload Photos</label>
            <input type="file" name="files[]" id="upload-photo" multiple required>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <?php
    include_once("database.php");

    session_start();
    $username = $_SESSION["username"];

    $query = $conn->query("SELECT * FROM photos WHERE USERNAME='$username'");
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $imageURL = 'images/' . $row["FILE_NAME"];
        }
        echo "<img src=\"$imageURL\" alt=\"\" />";
    } else {
        echo "<p>No image(s) found...</p>";
    }
    $conn->close();
    ?>
    <script>
        windows.onbeforeunload = function() {
             window.location.href = "logout.php";
        }
    </script>
</body>
</html>