<?php
include("navbar_default.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - LOGIN</title>
    
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>
    <!--MAIN CONTENT-->
    <form action="includes/login_check.inc.php" method="POST">
        <div class="container1">
            <div class="forms">
                <div class="form-content">
                    <div class="title">
                        Login
                    </div>
                    <div class="input-boxes">
                        <div class="input-box">
                            <input type="text" name="username"  placeholder="Enter your username"  required>
                        </div>
                        <div class="input-box">
                            <input type="password" name="password"  placeholder="Enter your password" required>
                        </div>
                        <?PHP
                            error_reporting(0);
                            session_start();
                            //session_destroy();
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p class='warning_msg'>Fill in all fields!</p>";
                                }
                                else if ($_GET["error"] == "errorlogin") {
                                    echo "<p class='warning_msg'>Incorrect login details!</p>";
                                }
                                else if ($_GET["error"] == "wrongpassword") {
                                    echo "<p class='warning_msg'>Password is incorrect!</p>";
                                }
                            }
                        ?>

                        <div class="text">
                            <!-- <a href="forgot-password.php">Forgot password?</a> -->
                        </div>
                        <div class="button input-box">
                            <input type="submit" name="submit" value="Log In">
                        </div>
                        <div class="text-center">
                            Don't have an account? 
                            <a href="signup_form.php">Signup now</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </form>

</body>
</html>

