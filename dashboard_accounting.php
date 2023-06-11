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
elseif($_SESSION['user_type'] === "admin")
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

include_once "includes/accounting_dashboard_display.inc.php";
include('navbar_sidebar_accounting.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Dashboard (Accounting)</title>

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
                                <div class="title-1">Credit Transaction</div>
                                <div class="mw-100 mw-100"  style="width: 800px;">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="container10">
                                <div class="title-1">Transaction Overview</div>
                                <div class="row">
                                    <!--Occupied-->
                                    <div class="col-md-4 col-xl-12">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Total count of Transactions Today:</h6>
                                                <h2 class="text-right"><i class="bx bx-taxi f-left"></i><span> 
                                                    <?php
                                                        if (empty($transac_count["transaction_count"])) {
                                                            echo "<span>0</span>";
                                                        } else {
                                                            echo "<span>{$transac_count["transaction_count"]}</span>";
                                                        }
                                                    ?>
                                                </span></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Available-->
                                    <div class="col-md-4 col-xl-12">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h6 class="m-b-20">Total amount of money received today:</h6>
                                                <h2 class="text-right"><i class="fas fa-parking f-left"></i><span>
                                                    <?php if (empty($total_amount["total_amount"])) {
                                                        echo "<span>0</span>";
                                                    } else {
                                                            echo "<span>{$total_amount["total_amount"]}</span>";
                                                    }?>
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
    <script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($date) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Total Amount of Money Received Per Day',
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
