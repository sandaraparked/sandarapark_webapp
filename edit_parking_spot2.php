<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
{
    header("location:login.php");
    exit();
}

include ("includes/parking_spot2.inc.php");
include("navbar_sidebar_admin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Edit Tech Educ BLDNG Parking Spot</title>

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
                    Edit Parking Spot (Tech Educ Building)
                </div>
                <p class="warning_msg">
                    <?php
                    error_reporting(0);
                    session_start();


                    echo $_SESSION['editp_message1'];
                    echo $_SESSION['editp_message2'];
                    ?>
                </p>
                <div class="input-boxes1">
                    <?php
                    if(isset($_GET['parking_id']))
                    {
                        $parking_id = $_GET['parking_id'];
                        $parking_spot1 = "SELECT * FROM parking_spot2 WHERE parking_id='$parking_id' ";
                        $parking_spot1_run = mysqli_query($conn, $parking_spot1);

                        if(mysqli_num_rows($parking_spot1_run) > 0)
                        {
                            foreach($parking_spot1_run as $parking)
                            {
                                ?>
                                <form action="includes/parking_spot2.inc.php" method="POST">
                                    <input type="hidden" name="parking_id" value="<?=$parking['parking_id'];?>">
                                    <div class="input-box1 col-sm-3">
                                        <label>Area</label>
                                        <br>
                                        <input type="text" name="area" value="<?=$parking['area'];?>">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Spot</label>
                                        <br>
                                        <input type="text" name="spot" value="<?=$parking['spot'];?>">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Availability</label>
                                        <br>
                                        <select name="availability" id = "availability">
                                            <option value="">Select One</option>
                                            <option value="available" <?= $parking['availability'] == 'available' ? 'selected':''?> >available</option>
                                            <option value="occupied"<?= $parking['availability'] == 'occupied' ? 'selected':''?> >occupied</option>
                                            <option value="reserved"<?= $parking['availability'] == 'reserved' ? 'selected':''?> >reserved</option>
                                            <option value="pwd"<?= $parking['availability'] == 'pwd' ? 'selected':''?> >pwd</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="button input-box">
                                            <input type="submit" name="update_parking_spot1" value="Update">
                                        </div>
                                    <div class="col-sm-3">
                                </form>
                                <?php
                            }
    
                        }
                        else
                        {
                            ?>
                                <h4>No record found</h4>
                            <?php
                        }
                    }
                    ?>
                        
                </div>
            </div>
        </div>
    </div>    


</body>
</html>