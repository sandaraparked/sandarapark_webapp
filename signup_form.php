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

    <title>RESPARKMAN - Signup</title>

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>
    <!--MAIN CONTENT-->
    <form method="POST" action="includes/signup.inc.php">
        <div class="container1">
            <div class="forms">
                <div class="form-content">
                    <div class="title">
                        Signup Now
                    </div>
                    <p class="warning_msg">
                    <?PHP
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "<p class='warning_msg'>Fill in all fields!</p>";
                            }
                            else if ($_GET["error"] == "invalidusername") {
                                echo "<p class='warning_msg'>Please input a proper username!</p>";
                            }
                            else if ($_GET["error"] == "invalidemail") {
                                echo "<p class='warning_msg'>Please input a proper email!</p>";
                            }
                            elseif ($_GET["error"] == "passwordsdontmatch") {
                                echo "<p class='warning_msg'>Password doesn't match!</p>";
                            }
                            elseif ($_GET["error"] == "usernametaken") {
                                echo "<p class='warning_msg'>Username already taken!</p>";
                            }
                            elseif ($_GET["error"] == "emailtaken") {
                                echo "<p class='warning_msg'>Email is already taken!</p>";
                            }
                            elseif ($_GET["error"] == "platenumtaken") {
                                echo "<p class='warning_msg'>Plate number is already taken!</p>";
                            }
                            elseif ($_GET["error"] == "stmtfailed") {
                                echo "<p class='warning_msg'>Something went wrong, try again!</p>";
                            }
                            elseif ($_GET["error"] == "consent") {
                                echo "<p class='warning_msg'> You cannot signup on our website if you do not agree with our Terms of Service, Privacy Policy and Consent Form!</p>";
                            }
                            elseif ($_GET["error"] == "none") {
                                echo "<p class='warning_msg'>Sign up successfully!. You can now login using the account you just registered.</p>";
                            }
                        }
                        ?>
                    </p>
                    <div class="input-boxes">
                        <div class="input-box">
                            <input type="text" name = "name" required placeholder="Enter your name (FN MI. LN)">
                        </div>
                        <div class="input-box">
                            <input type="text" name = "plate_num" required placeholder="Enter your plate number">
                        </div>
                        <!-- <div class="input-box">-->
                            <input type="hidden" name = "email" value="">
                        <!--</div> -->
                        <div class="input-box">
                            <input type="text" name = "username" required placeholder="Enter your username">
                        </div>
                        <div class="input-box">
                            <input type="password" name = "password" required placeholder="Enter your password">
                        </div>
                        <div class="input-box">
                            <input type="password" name = "c_password" required placeholder="Confirm your password">
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="checkbox" name="consent" required>
                            <span class="checkmark"></span>
                            I have read and agree to the <a href="terms_and_conditions.php#terms_of_service">Terms of Service</a>, <a href="terms_and_conditions.php#privacy_policy">Privacy Policy</a> and <a href="terms_and_conditions.php#consent_form">Consent Form</a>.
                        </div>
                        <div class="button input-box">
                            <input type="submit" name="signup_submit" value="Submit">
                        </div>
                        <div class="text-center">
                            Already have an account?
                            <a href="login.php">Login now</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </form>
</div>
</body>
</html>