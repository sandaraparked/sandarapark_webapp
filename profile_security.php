<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['user_id']))
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "admin")
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "accounting")
{
    header("location:login.php");
    exit();
}
include("navbar_sidebar_security.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Profile (Security)</title>

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
    <div class="container2">
        <div class="forms">
            <div class="form-content">
                <div class="title">
                    Personal Information
                </div>
                <?php
                include('message.php');
                ?>
                <div class="d-none">
                    <?php
                        echo "".$_SESSION["user_id"]."";
                    ?>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-2">
                        <label class="font-weight-bold">Name:</label>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            echo "".$_SESSION["name"]."";
                        ?>
                    </div>
                </div>
                <!-- <br>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Email:</label>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            echo "".$_SESSION["email"]."";
                        ?>
                    </div>
                </div> -->
                <br>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Username:</label>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            echo "".$_SESSION["username"]."";
                        ?>
                    </div>
                </div>
                <!-- <br>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Plate Number:</label>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            echo "".$_SESSION["plate_num"]."";
                        ?>
                    </div>
                </div> -->
                <br>
                <br>
                <div class="col-sm-4">
                    <a href='edit_profile_security.php?id=<?= $_SESSION["user_id"] ?>' class='btn btn-primary btn-block link-light nounderline w-100'>Edit Profile</a>
                    <br>
                    <br>
                    <a href='change_password_security.php?id=<?= $_SESSION["user_id"] ?>' class='btn btn-primary btn-block link-light nounderline w-100'>Change Password</a>
                </div>
            </div>
        </div>
    </div>

</body>


</html>