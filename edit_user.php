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
include "users_processing.php";
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

    <title>RESPARKMAN - Edit Employee Account Information</title>

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
    <div class="container1">
        <div class="forms">
            <div class="form-content">
                <div class="title">
                    Edit Users
                </div>
                <?php
                    error_reporting(0);
                    session_start();
                    
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            echo "<p class='warning_msg'>Fill in all fields!</p>";
                        }
                        else if ($_GET["error"] == "invalidusername") {
                            echo "<p class='warning_msg'>Please input a proper username!</p>";
                        }
                        else if ($_GET["error"] == "invalidemail") {
                            echo "<p class='warning_msg'>Please input a proper email!</p>";
                        }
                        elseif ($_GET["error"] == "passwordsdontmatch") {
                            echo "<p class='warning_msg'>Password doesn't match!</p>";
                        }
                        elseif ($_GET["error"] == "stmtfailed") {
                            echo "<p class='warning_msg'>Something went wrong, try again!</p>";
                        }

                        elseif ($_GET["error"] == "none") {
                            $_SESSION['message'] = "User information updated successfully"; 
                            header('location:manage_users.php');
                        }
                    }
                ?>
                <div class="input-boxes1">
                    <?php
                    if(isset($_GET['user_id']))
                    {
                        include "includes/encdec.inc.php";
                        $e_user_id = $_GET['user_id'];
                        $allusers = "SELECT * FROM user WHERE user_id='$e_user_id' ";
                        $allusers_run = mysqli_query($conn, $allusers);

                        if(mysqli_num_rows($allusers_run) > 0)
                        {
                            foreach($allusers_run as $users)
                            {
                                $name = openssl_decrypt($users["name"], $method, $key, 0, $users["vi"]);
                                $email = openssl_decrypt($users["email"], $method, $key, 0, $users["vi"]);
                                $plate_num = openssl_decrypt($users["plate_num"], $method, $key, 0, $users["vi"]);
                                $username = openssl_decrypt($users["username"], $method, $key, 0, $users["vi"]);

                                ?>
                                <form action="includes/edit_user.inc.php" method="POST">
                                    <input type="hidden" name="e_user_id" value="<?=$users['user_id'];?>">

                                        <input type="hidden" name="email" value="<?=$email;?>">

                                        <input type="hidden" name="username" value="<?=$username;?>">

                                        <input type="hidden" name="plate_num" value="<?=$plate_num;?>">

                                    <div class="input-box1">
                                        <label>Name</label>
                                        <br>
                                        <input type="text" name="name" value="<?=$name;?>">
                                    </div>
                                    <div class="input-box1">
                                        <label>Role</label>
                                        <br>
                                        <select name="user_type">
                                            <option value="">Select Role</option>
                                            <option value="admin" <?= $users['user_type'] == 'admin' ? 'selected':''?> >admin</option>
                                            <option value="security"<?= $users['user_type'] == 'security' ? 'selected':''?> >security</option>
                                            <option value="accounting"<?= $users['user_type'] == 'accounting' ? 'selected':''?> >accounting</option>
                                        </select>
                                    </div>
                                    <div class="button input-box">
                                        <input type="submit" name="update_user" value="Update User">
                                    </div>
                            
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