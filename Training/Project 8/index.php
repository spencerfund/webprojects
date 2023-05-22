<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <?php
        if (isset($_GET['login_success']) && $_GET['login_success'] == 0) {
            echo "<p style=\"text-align: center; margin-top: 10px; color: red;\">Login Failed</p>";
        }    

        if (isset($_GET['logout']) && $_GET['logout'] == true) {
            echo    '<div id="logout-confirm">
                        <div class="logout-text">
                            <h1>You have successfully been logged out</h1>
                            <button id="closeLogout" class="button">Close</button>
                        </div>
                    </div>';
        }
    ?>
    <div id="loginbox">
        <form action="login.php" id="loginForm" method="post" enctype="multipart/form-data">
            <div class="box-header">
                <h1>Login</h1>
                <span class="material-symbols-rounded" id="closeLogin">close</span>
            </div>
            <div>
                <p>Username</p>
                <input type="text" name="username" id="username2">
            </div>
            <div>
                <p>Password</p>
                <input type="password" name="password" id="password2">
            </div>
            <input class="button" type="submit" name="submit" value="Login" id="loginBtn">
            <p class="subscript">Don't have an account? <a href="#" id="toRegister">Register here</a></p>
        </form>
        <form action="register.php" id="registerForm" method="post" enctype="multipart/form-data">
            <div class="box-header">
                <h1>Register</h1>
                <span class="material-symbols-rounded" id="closeRegister">close</span>
            </div>
            <div>
                <p>First Name</p>
                <input type="text" name="first-name" id="first-name">
            </div>
            <div>
                <p>Last Name</p>
                <input type="text" name="last-name" id="last-name">
            </div>
            <div>
                <p>Username</p>
                <input type="text" name="username" id="username">
            </div>
            <div>
                <p>Password</p>
                <input type="password" name="password" id="password">
            </div>
            <input class="button" type="submit" name="submit" value="Register" id="registerBtn">
            <p class="subscript">Aready have an account? <a href="#" id="toLogin">Login here</a></p>
        </form>
    </div>
    <div id="btnbox">
        <?php
        if (isset($_GET['login_success']) && $_GET['login_success'] == 1) {
            session_start();
            $firstName = $_SESSION["firstName"];
            $lastName = $_SESSION["lastName"];
            $username = $_SESSION["username"];
            echo "<p id=\"user\">" . $firstName . " " . $lastName . "</p>";
            echo "<button onclick=\"location.href='logout.php'\" id=\"logout\">Logout</button>";
        } else {
            echo "<button id=\"login\">Login</button>";
            $username = "";
        }
        ?>
        <span id="storage" data-username="<?php echo $username; ?>"></span>
    </div>
    <div class="wrapper">
        <header>
            <div class="icons">
                <span id="prev" class="material-symbols-rounded">chevron_left</span>
            </div>
            <p class="current-date"></p>
            <div class="icons">
                <span id="next" class="material-symbols-rounded">chevron_right</span>
            </div>
        </header>
        <div class="calendar">
            <ul class="weeks">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
            </ul>
            <ul class="days"></ul>
        </div>
    </div>
</body>
</html>