<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['username']))
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "security")
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "accounting")
{
    header("location:login.php");
    exit();
}
include('navbar_sidebar_admin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Add Employee Account</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>
    <!--Main Content-->
    <div class="container1">
        <div class="forms">
            <div class="form-content">
                <div class="title">
                    Add Users
                </div>
                <p class='warning_msg'>
                    <?php
                    error_reporting(0);
                    session_start();
                    
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

                        elseif ($_GET["error"] == "none") {
                            $_SESSION['message'] = " User information updated successfully"; 
	                        header('location:manage_users.php');
                            exit(0);
                        }
                    }
                    ?>
                </p>
                    <div class="input-boxes">
                        <form action="includes/add_user.inc.php" method="POST">
                            <div class="input-box1">
                                <label>Name (FN MI. LN)</label>
                                <br>
                                <input type="text" name="name" required>
                            </div>
                            <div class="input-box1">
                                <input type="hidden" name="plate_num" value="">
                            </div>
                            <div class="input-box1">
                                <input type="hidden" name="email" value="">
                            </div>
                            <div class="input-box1">
                                <label>Username</label>
                                <br>
                                <input type="text" name="username" required>
                            </div>
                            <div class="input-box1">
                                <label>Password</label>
                                <br>
                                <input type="password" name="password" id="password" required>
                            </div>
                            <div class="input-box1">
                                <label>Confirm Password</label>
                                <br>
                                <input type="password" name="c_password" id="c_password" required>
                            </div>
                            <div class="input-box1">
                                <label>Role</label>
                                <br>
                                <select name="user_type" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">admin</option>
                                    <option value="security">security</option>
                                    <option value="accounting">accounting</option>
                                    </select>
                                    </div>
                            <div class="button input-box">
                                <input type="submit" name="add_user" value="Add User">
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <script>
        var password = document.getElementById("password"),
            confirm_password = document.getElementById("c_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>

</body>
</html>