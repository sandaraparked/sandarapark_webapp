<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']))
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
elseif($_SESSION['user_type'] === "security")
{
    header("location:login.php");
    exit();
}

unset($_SESSION["date1"]);
unset($_SESSION["date2"]);
unset($_SESSION["time1"]);
unset($_SESSION["time2"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Vehicle Entry Logs</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 

    <!-- jQuery CDN  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"> </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Datepicker CSS -->
	<link href="assets/css/bootstrap-datepicker.css" rel="stylesheet" />
	<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Timepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" integrity="sha512-E4kKreeYBpruCG4YNe4A/jIj3ZoPdpWhWgj9qwrr19ui84pU5gvNafQZKyghqpFIHHE4ELK7L9bqAv7wfIXULQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
    .input-container {
    display: inline-block;
    margin-right: 20px;
    margin-bottom: 10px;
    }

    .input-container label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    }
    </style>

</head>

<body>
    <!--Side Bar-->
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-times"></i>
            </div>
            <div class="sidebar-header">
                <?php
                    echo "".$_SESSION["name"]."";
                ?>
                <br>
                UID:
                <?php
                    echo "".$_SESSION["user_id"]."";
                ?>
            </div>
            <hr>
            <ul class="list-unstyled">
            <?PHP
                            error_reporting(0);
                            session_start();
                            if($_SESSION["ps_status"] == "on"){
                                
            ?>
            <li><a><i class="bx bx-money"></i>
            <?php echo "Balance: Php $_SESSION[credit_balance]"; ?>
            </a></li>
            <li><a href="ticket.php"><i class="bx bx-receipt"></i>Ticket information</a></li>
            <?php
                            }
            ?>
                <li><a href="dashboard_user.php"><i class="bx bx-grid-altbx bx-grid-alt"></i>Dashboard</a></li>
                <li><a href="profile_user.php"><i class="bx bx-user"></i>Profile</a></li>
                <li><a href="includes/logout.inc.php"><i class="bx bx-log-out"></i>Logout</a></li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <!--Navigation Bar-->
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="header1">
                        <button type="button" id="sidebarCollapse" class="btn-bars">
                            <i class="fas fa-bars"></i>
                        </button>
                        <img src="images/resparkman-logo.png" class="img-logo1">
                        <div class="txt-logo">
                            RESPARKMAN
                        </div>
                    </div>
                </div>
            </nav>
            <!--Main Content-->
            <div class="container2">
                <div class="forms">
                    <div class="form-content">
                        <div class="title">
                            Vehicle Entry Logs
                        </div>
                        <br>
                        <?php 
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "date1Required") {
                                $_SESSION['r_message'] = "Select a starting date to filter results"; 
                                header('location:vehicle_entry_logs1.php');
                            }

                            elseif ($_GET["error"] == "timeRequired") {
                                $_SESSION['r_message'] = "Enter time to filter results"; 
                                header('location:vehicle_entry_logs1.php');
                            }

                            elseif ($_GET["error"] == "stmtfailed") {
                                $_SESSION['y_message'] = "Something went wrong! Please try again."; 
                                header('location:vehicle_entry_logs1.php');
                            }
                        }

                        include('message.php');
                        ?>
                        <h3>Filter results:</h3>
                        <form action="includes/user_vehicle_entry_logs.inc.php" method="POST">
                        <div class="input-container">
                            <label for="date1">Entry Date (from):</label>
                            <input class="datepicker form-control" type="text" id="date1" name="date1" placeholder="yyyy/mm/dd">
                        </div>                
                        <div class="input-container">
                            <label for="date2">Entry Date (to):</label>
                            <input class="datepicker form-control" type="text" id="date2" name="date2" placeholder="yyyy/mm/dd">
                        </div>
                        <div class="input-container">
                            <label for="time1"> Transaction time (from):</label>
                            <input class="form-control timepicker" type="text" id="time1" name="time1" placeholder="--:-- --">
                        </div>
                        <div class="input-container">
                            <label for="time2">Transaction time (to):</label>
                            <input class="form-control timepicker" type="text" id="time2" name="time2" placeholder="--:-- --">
                        </div>
                        <div class="input-container">
                            <input class="add-btn link-light nounderline" type="submit" id="filter" name="filter" value="Filter results">
                        </div>
                        </form>
                        <div class="table-responsive">
                            <table class="styled-table">
                                <thread>
                                    <tr>
                                        <th>Record ID</th>
                                        <th>UID</th>
                                        <th>Name</th>
                                        <th>Plate number</th>
                                        <th>Entry Date <br> (YYY-MM-dd) </th>
                                        <th>Entry Time <br> (24:00:00) </th>
                                    </tr>
                                </thread>
                                <tbody>
                                    <?php
                                    include('includes/user_vehicle_entry_logs.inc.php');
                                    include "includes/encdec.inc.php";
                                    while($row = mysqli_fetch_array($result)){
                                        $name = openssl_decrypt($row["name"], $method, $key, 0, $row["vi"]);
                                        $plate_num = openssl_decrypt($row["u_plate_num"], $method, $key, 0, $row["vi"]);

                                        ?>
                                        <tr>
                                        <td><?= $row["entry_id"] ?></td>
                                        <td><?= $row["user_id"] ?></td>
                                        <td><?= $name ?></td>
                                        <td><?= $plate_num ?></td>
                                        <td><?= $row["date_in"] ?></td>
                                        <td><?= $row["time_in"] ?></td>
                                        </tr>
                                        <?php
                                }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="container4">
                            <div class="pagination">
                            <?php
                            // display the links to the pages
                            for ($page=1;$page<=$number_of_pages;$page++) {
                                echo '<a href="user_vehicle_entry_log1.php?page=' . $page . '">' . $page . '</a> ';
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

    
    <!--Panzoom-->
    <script src="https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <!--Side bar-->
    <script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
    </script>

    <!-- Datepicker --> 
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format:'yyyy/mm/dd',
            weekStart:1,
            color: 'green'
        });
	</script>

    <!--Timepicker-->
    <!--Timepicker-->
    <script type="text/javascript">
        $('.timepicker').timepicker({
            minuteStep: 1,
            showInputs: false,
            pick12HourFormat: false,
            pickSeconds: true,
            defaultTime: null,
            startDate: -Infinity,
            endDate: Infinity,
            icons: {
                time: "bx bx-time",
                up: "bx bx-chevron-up",
                down: "bx bx-chevron-down",
            }
        });
    </script>
   

    <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
        modal.style.display = "none";
        }
    }
    
    </script>
    
</body>
</html>