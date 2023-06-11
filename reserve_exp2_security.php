<?PHP
error_reporting(0);
session_start();

if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']))
{
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
{
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "admin")
{
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "accounting")
{
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
include 'rs_conn2.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>RESPARKMAN - Tech Educ BLDNG Parking (Security)</title>
    
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/reserve2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
    </script>

</head>

<style>
.seat.reserved {
    pointer-events: none;
}

.seat.occupied {
    pointer-events: none;
}

.seat.pwd {
    pointer-events: none;
}
</style>

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
                <li><a href="dashboard_security.php"><i class="bx bx-grid-altbx bx-grid-alt"></i>Dashboard</a></li>
                <li><a href="profile_security.php"><i class="bx bx-user"></i>Profile</a></li>
                <li><a href="manage_parking.php"><i class="bx bx-taxi"></i>View Parking Area</i></a></li>
                <li><a href="vehicle_entry_logs1.php"><i class="bx bx-folder"></i>Vehicle Entry Logs</i></a></li>
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
            <div class="container-p">
                <div class="forms">
                    <div class="form-content">
                        <div class="header"> Parking Overview </div>
                        <div class="subheader"> Choose a parking slot </div>
                        <div class="path">
                            <a href="dashboard_security.php"> Dashboard </a>/<a href="manage_parking.php"> TUP Parking </a>/ Tech Educ Building 
                        </div>
                        <div class="nxt-b">
                            <a class="btn btn-outline-primary" href="reserve_exp1_admin.php" role="button">Previous</a>
                        </div>
                        <div class="container-t">
                            <div class="forms" id="parking2">
                                <ul class="showcase-main2">
                                    <div class="screen">Tech Educ Building</div>
                                    <div class="row2">
                                        <?PHP
                                            session_start();
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            echo "
                                                <div class='seat $row[availability]'><a href='#'>$row[spot]</a></div>";
                                            }
                                        ?>
                                    </div>
                                </ul>   
                            </div>
                            <ul class="showcase-legend2">
                                <li>
                                    <div class="legendavailable"></div>
                                    <small>Available</small>
                                </li>
                                <li>
                                    <div class="legendreserved"></div>
                                    <small>Reserved</small>
                                </li>
                                <li>
                                    <div class="legendoccupied"></div>
                                     <small>Occupied</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

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

<script>
setInterval(function(){
    $("#parking2").load("parking_space2.php #parking2");
}, 5000);
</script>

</body>
</html>