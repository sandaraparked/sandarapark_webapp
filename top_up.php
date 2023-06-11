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
elseif($_SESSION['user_type'] === "security")
{
    header("location:login.php");
    exit();
}

require_once ("includes/dbhed.inc.php");
if ($_SESSION['user_type'] === "admin" ){
    include("navbar_sidebar_admin.php");
} elseif($_SESSION['user_type'] === "accounting" ) {
    include("navbar_sidebar_accounting.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Top up Credit</title>

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
                    Top-up Credit
                </div>
                <?php 
                include('message.php');
                ?>
                <p class="warning_msg">
                <?PHP
                            error_reporting(0);
                            session_start();
                            //session_destroy();
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p class='warning_msg'>Fill in all fields!</p>";
                                }
                                else if ($_GET["error"] == "transactionerror") {
                                    echo "<p class='warning_msg'>Error processing the transaction.</p>";
                                }
                                else if ($_GET["error"] == "wrongcredentials") {
                                    echo "<p class='warning_msg'>The UID and/or plate number are incorrect</p>";
                                }
                                else {

                                }
                            }
                        ?>
                </p>
                <div class="input-boxes1">
                                <form action="includes/top_up.inc.php" method="POST">
                                    <div class="input-box1 col-sm-3">
                                        <label>UID</label>
                                        <br>
                                        <input type="text" name="tp_user_id" placeholder="ex.: 12345">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Plate Number</label>
                                        <br>
                                        <input type="text" name="tp_plate_num" placeholder="ex.: ABC-123">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Amount (in Php)</label>
                                        <br>
                                        <input type="text" name="amount" placeholder="ex.:100">
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="button input-box">
                                            <input type="submit" name="submit_check" value="Next">
                                        </div>
                                    <div class="col-sm-3">
                                </form>
                </div>
            </div>
        </div>
    </div>    

</body>
</html>