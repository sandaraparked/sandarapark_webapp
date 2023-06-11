<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
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
require_once "includes/admin_dashboard_display.inc.php";
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

    <title>RESPARKMAN - Dashboard (Admin)</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
                        echo "".$_SESSION["name"]."";
                    ?>
                </span>
                </div>
                <br>
                <div class="container10">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="container10">
                                <!--Chart-->
                                <div class="title-1">Vehicle Entry</div>
                                <div class="mw-100 mw-100"  style="width: 800px;">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <br>
                                <!--Manage Parking-->
                                <div class="title-1">Manage parking</div>
                                    <div class="row">
                                        <!--Parking Areas-->
                                        <div class="col-md-3 col-xl-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="manage_parking.php">TUP Manila Map</a></h5>
                                                    <p class="card-text">View available parking areas</p>
                                                    <div class="text-center">
                                                        <a href="reserve_exp1_admin.php" class="btn btn-secondary btn-sm link-light nounderline w-75 mb-2">IRTC Bldg</a>
                                                        <a href="reserve_exp2_admin.php" class="btn btn-secondary btn-sm link-light nounderline w-75">Tech Educ Bldg</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Enable Payment-->
                                        <div class="col-md-3 col-xl-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="payment_system.php">Payment status</a></h5>
                                                    <p class="card-text">Change the Parking Payment Status:</p>
                                                    <div class="text-center">

                                                        <?PHP
                                                                session_start();
                                                                if ($_SESSION["ps_status"] == "on") {
                                                                    echo "
                                                                    <a href='payment_system.php' class='btn btn-secondary btn-sm link-light nounderline w-75 mb-2'>Payment Status: ON </a>
                                                                        ";
                                                                }
                                                                else {
                                                                    session_start();
                                                                    $_SESSION["payment_system"] = "off";
                                                                    echo "
                                                                    <a href='reserve_exp1_admin.php' class='btn btn-secondary btn-sm link-light nounderline w-75 mb-2'>Payment Status: OFF </a>
                                                                        ";
                                                                }
                                                            ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="container10">
                                    <div class="title-1">Parking Overview</div>
                                    <div class="row">
                                        <!--Occupied-->
                                        <div class="col-md-4 col-xl-12">
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
                                        <div class="col-md-4 col-xl-12">
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
                                        <div class="col-md-4 col-xl-12">
                                            <div class="card bg-c-yellow order-card">
                                                <div class="card-block">
                                                    <h6 class="m-b-20">Reserved Spots</h6>
                                                    <h2 class="text-right"><i class="fas fa-ticket-alt f-left"></i><span>
                                                        <?php print_r($t_reserved["total_count"])?>/<?php print_r($total["total_count"])?>
                                                    </span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <!--PWD-->
                                        <div class="col-md-4 col-xl-12">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($date) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Total count of vehicle entry per day',
      data: <?php echo json_encode($count) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 2
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</body>


</html>