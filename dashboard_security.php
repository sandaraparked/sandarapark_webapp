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
require_once "includes/admin_dashboard_display.inc.php";
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

    <title>RESPARKMAN - Dashboard (Security)</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    
</head>

<body>
    <!--Main Content-->
    <div class="container2">
        <div class="forms">
            <div class="form-content">
                <div class="title">
                <?php
                date_default_timezone_set('Asia/manila');
                     $hour = date('G');
                if ($hour >= 0 && $hour <= 11) {
                    echo "Good Morning,";
                } else if ($hour >= 12 && $hour <= 17) {
                    echo "Good Afternoon,";
                } else if ($hour >= 18 || $hour <= 23) {
                    echo "Good Evening,";
                }
                ?>
                <span class="text-black fw-bold">
                <?php //echo isset($user['username']) ? $user['username'] : '';
                error_reporting(0);
                session_start();
                echo "".$_SESSION["name"]."";
                ?>
                </span>
                </div>
                <div class="title-1">Parking Overview</div>
                <div class="row">
                    <!--Occupied-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Occupied Spots</h6>
                                <h2 class="text-right"><i class="bx bx-taxi f-left"></i><span> 
                                    <?php print_r($t_occupied["total_count"])?>/<?php print_r($total["total_count"])?>
                                </span></h2>
                            </div>
                        </div>
                    </div>
                    <!--Available-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-green order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Available Spots</h6>
                                <h2 class="text-right"><i class="fas fa-parking f-left"></i><span>
                                    <?php print_r($t_available["total_count"])?>/<?php print_r($total["total_count"])?>
                                </span></h2>
                            </div>
                        </div>
                    </div>
                    <!--Reserved-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Reserved Spots</h6>
                                <h2 class="text-right"><i class="fa fa-ticket f-left"></i><span>
                                    <?php print_r($t_reserved["total_count"])?>/<?php print_r($total["total_count"])?>
                                </span></h2>
                            </div>
                        </div>
                    </div>
                    <!--PWD-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">PWD Parking Spots</h6>
                                <h2 class="text-right"><i class="fa fa-wheelchair f-left"></i><span>
                                    <?php print_r($t_pwd["total_count"])?>/<?php print_r($total["total_count"])?>
                                </span></h2>
                            </div>
                        </div>
                    </div>
	            </div>
                <div class="row">
                <!--Parking Areas-->
                <div class="col-md-3 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="manage_parking.php">TUP Manila Map</a></h5>
                            <p class="card-text">View parking areas and available parking spots</p>
                            <div class="text-center">
                                <a href="reserve_exp1_security.php" class="btn btn-secondary btn-sm link-light nounderline w-75 mb-2">IRTC Bldg</a>
                                <a href="reserve_exp2_security.php" class="btn btn-secondary btn-sm link-light nounderline w-75">Tech Educ Bldg</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Access Vehicle Entry Logs-->
                <div class="col-md-3 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="vehicle_entry_logs1.php">Vehicle Entry Logs</a></h5>
                            <p class="card-text">View the records of the Vehicles that entered the establishment.</p>
                            <div class="text-center">
                            <a href="vehicle_entry_logs1.php" class="btn btn-secondary btn-sm link-light nounderline w-75 mb-2">Entry Records</a><br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>