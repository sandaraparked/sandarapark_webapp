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

    <title>RESPARKMAN - Top up Confirmation</title>

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
                    Top up Confirmation
                </div>
                <div class="input-boxes1">
                                <form action="includes/top_up.inc.php" method="POST">
                                    <div class="input-box1 col-sm-3">
                                        <label>You are about to cash in</label>
                                        <br>
                                        <input type="text" name="amount" readonly value="<?php echo $_SESSION["amount"]; ?>">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>to the account/user with the following information</label>
                                        <br>
                                        <br>
                                        <label>UID:</label>
                                        <input type="text" name="tp_user_id" readonly value="<?php echo $_SESSION["tp_user_id"]; ?>">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Plate number:</label>
                                        <br>
                                        <input type="text" name="tp_plate_num" value="<?php echo $_SESSION["tp_plate_num"]; ?>" readonly>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="button input-box">
                                            <input type="submit" name="confirm" value="confirm">
                                        </div>
                                    <div class="col-sm-3">
                                </form>
                </div>
            </div>
        </div>
    </div>    

</body>
</html>

