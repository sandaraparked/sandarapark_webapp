<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['username']))
{
    header("location:login.php");
    exit();
}elseif($_SESSION['user_type'] === "admin")
{
    header("location:login.php");
    exit();
}elseif($_SESSION['user_type'] === "accounting")
{
    header("location:login.php");
    exit();
}elseif($_SESSION['user_type'] === "security")
{
    header("location:login.php");
    exit();
}

include("navbar_sidebar_user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Ticket information</title>
    
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
                    Ticket information
                </div>
                <div class="input-boxes1">
                                <form action="includes/payment.inc.php" method="POST">
                                    <div class="input-box1 col-sm-3">
                                        <label>Ticked id#</label>
                                        <br>
                                        <input type="text" name="user_id" readonly hidden value="<?= $_SESSION["user_id"]; ?>">
                                        <input type="text" name="amount" readonly value="01">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Date in:</label>
                                        <input type="text" name="date_created" readonly value="dd/mm/yyyy">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Time in:</label>
                                        <br>
                                        <input type="text" name="time_created" value="hh:mm:ss" readonly>
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Elapsed time:</label>
                                        <br>
                                        <input type="text" name="elap_time" value="hh:mm:ss" readonly>
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Amount due:</label>
                                        <br>
                                        <input type="text" name="amount_due" value="30" readonly>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="button input-box">
                                            <input type="submit" name="unparkpay" value="un-park and pay">
                                        </div>
                                    <div class="col-sm-3">
                                </form>
                </div>
            </div>
        </div>
    </div>    

</body>
</html>

