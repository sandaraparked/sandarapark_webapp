<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['username']))
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "accounting")
{
    header("location:login.php");
    exit();
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

    <title>RESPARKMAN - Manage Parking</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <style>
        .center{
            text-align:center;
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
            <?php

                            if($_SESSION["user_type"] === "security"){
            ?>
                <li><a href="dashboard_security.php"><i class="bx bx-grid-altbx bx-grid-alt"></i>Dashboard</a></li>
                <li><a href="profile_security.php"><i class="bx bx-user"></i>Profile</a></li>
                <li><a href="manage_parking.php"><i class="bx bx-taxi"></i>View Parking Area</i></a></li>
                <li><a href="vehicle_entry_logs1.php"><i class="bx bx-folder"></i>Vehicle Entry Logs</i></a></li>
                <?PHP
                            }
                            error_reporting(0);
                            session_start();
                            if($_SESSION["user_type"] === "admin"){
                                
                ?>
                <li><a href="dashboard_admin.php"><i class="bx bx-grid-altbx bx-grid-alt"></i>Dashboard</a></li>
                <li><a href="profile_admin.php"><i class="bx bx-user"></i>Profile</i></a></li>
                <li><a href="manage_users.php"><i class="bx bx-user-plus"></i>Manage Users</i></a></li>
                <li><a href="manage_parking.php"><i class="bx bx-taxi"></i>Manage Parking Area</i></a></li>
                <li><a href="#records" data-toggle="collapse" aria-expanded="false"><i class="bx bx-folder-open"></i>Access Records</a></li>
                    <ul class="collapse list-unstyled" id="records">
                        <li>
                            <a href="digital_footprint1.php"><i class="bx bx-folder"></i>Digital Footprints</a>
                        </li>
                        <li>
                            <a href="credit_transactions1.php"><i class="bx bx-folder"></i>Credit Transactions</a>
                        </li>
                        <li>
                            <a href="vehicle_entry_logs1.php"><i class="bx bx-folder"></i>Vehicle Entries</a>
                        </li>
                    </ul>
                <li><a href="top_up.php"><i class="bx bx-credit-card"></i>Top up Credit</i></a></li>
                <?PHP
                        }
                ?>
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
                            Technological University of the Philippines
                        </div>
                        <br>
                        <div id="map" class="map-container">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

    <!-- jQuery CDN  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"> </script>
    <!--Panzoom-->
    <script src="https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Leaflet -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

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

    <!--TUP Map-->
    <script type="text/javascript">
        // Variables
        var mapSW = [0, 4096],
            mapNE = [4096, 0];

        // Declare Map Object
        var map = L.map('map').setView([0, 0], 1);

        // Reference the tiles
        L.tileLayer('images/map/{z}/{x}/{y}.png', {
            minZoom: 2,
            maxZoom: 4,
            continuousWorld: false,
            noWrap: true,
            crs: L.CRS.Simple,
        }).addTo(map);
        
        map.setMaxBounds(new L.LatLngBounds(
            map.unproject(mapSW, map.getMaxZoom()),
            map.unproject(mapNE, map.getMaxZoom())
        ));

        // Icons
        var parking_icon= L.icon({
            iconUrl: 'images/parking-icon.png',
            iconSize: [25, 41],
            iconAnchor: [20, 41],
            popupAnchor: [-8, -41],
            shadowUrl: 'images/marker-shadow.png',
            shadowSize: [41, 41],
            shadowAnchor: [20, 41]
        });
        <?php

if($_SESSION["user_type"] === "admin"){
?>
        // Markers and Popups
        var marker_irtc = L.marker(map.unproject([2611, 2512], map.getMaxZoom()), {icon: parking_icon}).bindPopup('<img src="images/IRTC.jpg" width="100%" height="100%"> <br> <p class="center"> <a href="reserve_exp1_admin.php">IRTC Building</a> <p>', {
            minWidth : 150
        });

        var marker_techeduc = L.marker(map.unproject([2713, 2389], map.getMaxZoom()), {icon: parking_icon}).bindPopup('<img src="images/Tech-educ.jpg" width="100%" height="100%"> <br> <p class="center"> <a href="reserve_exp2_admin.php">Tech Educ Bldg</a> <p>', {
            minWidth :150
        });
<?php
 }
 if($_SESSION["user_type"] === "security"){
?>
        var marker_irtc = L.marker(map.unproject([2611, 2512], map.getMaxZoom()), {icon: parking_icon}).bindPopup('<img src="images/IRTC.jpg" width="100%" height="100%"> <br> <p class="center"> <a href="reserve_exp1_security.php">IRTC Building</a> <p>', {
            minWidth : 150
        });

        var marker_techeduc = L.marker(map.unproject([2713, 2389], map.getMaxZoom()), {icon: parking_icon}).bindPopup('<img src="images/Tech-educ.jpg" width="100%" height="100%"> <br> <p class="center"> <a href="reserve_exp2_security.php">Tech Educ Bldg</a> <p>', {
            minWidth :150
        });
<?PHP
 }
 ?>
        // Layer Groups
        var parking_spots = L.layerGroup([marker_irtc, marker_techeduc]).addTo(map);
        
        var overlays ={
            "Parking Spots" : parking_spots,
        }

        // Add layer control
        L.control.layers(null, overlays).addTo(map);

        //para malaman coordinates
        //var marker = L.marker([0, 0], {draggable: true,}).addTo(map);

        //marker.on('dragend', function(e){alert(marker.getLatLng().toString()+ '<br />' + 'Pixels' + map.project(marker.getLatLng(), map.getMaxZoom().toString()));});
        
    </script>
</body>
</html>