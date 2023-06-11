<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "admin")
{
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "accounting")
{
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "security")
{
    session_destroy();
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

    <title>RESPARKMAN - Dashboard (User)</title>

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
                    <?php 
                    error_reporting(0);
                    session_start();
                    echo "".$_SESSION["name"]."";
                    ?>
                    </span>
                </div>
                <div class="container10">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="container10">
                                <div class="col-md-4 col-xl-6">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Balance</h6>
                                                <h2 class="text-right"><i class="fas fa-money f-left"></i><span>
                                                    <?php echo "Php $_SESSION[credit_balance]"; ?>
                                                </span></h2>
                                            </div>
                                        </div>
                                    </div>
                                <div class="title-1">
                                    Available Parking Establishments
                                </div>
                                <br>
                                <div class="col-sm-7">
                                    <div class="overviewcard">
                                        <img src="images/tup-logo.png" class="img-form1">
                                        <div class="text-left">
                                            <a href="user_parking_map.php">Technological University of the Philippines - Manila</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="container10 d-flex justify-content-end">            


                                <div class="card" style="width: 20rem;">
                                    <div class="card-header">
                                        <div class="title-1">
                                            Parking History
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table table-responsive">
                                            <table class="styled-table1">
                                                <tbody>
                                                    <?php
                                                        include('includes/user_vehicle_entry_logs.inc.php');
                                                        include "includes/encdec.inc.php";
                                                        while($row = mysqli_fetch_array($result)){
                                                            $name = openssl_decrypt($row["name"], $method, $key, 0, $row["vi"]);
                                                            $plate_num = openssl_decrypt($row["u_plate_num"], $method, $key, 0, $row["vi"]);

                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <i class="bx bx-time icon"></i>
                                                                    <?= $row["date_in"] ?>, <?= $row["time_in"] ?>
                                                                    <br>
                                                                    <small>TUP-Manila</small>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <a href="user_vehicle_entry_log1.php">See more >></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>