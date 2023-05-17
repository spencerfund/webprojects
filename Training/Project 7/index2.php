<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="break"></div>
    <div class="form_holder">
        <h1>Login</h1>
        <div class="break"></div>
        <form action="login.php" method="post" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <div class="break"></div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required="required">
            <div class="break"></div>
            <input type="submit" value="Submit">
        </form>
        <?php
        if (isset($_GET['login_success']) && $_GET['login_success'] == 0) {
            echo "<p style=\"text-align: center; margin: 10px; color: red;\">Username or password incorrect</p>";
        }
        ?>
    </div>
    <div class="link-holder">
        <p>Don't have an account?</p>
        <a href="index.php">Sign Up</a>
    </div>
</body>
</html>