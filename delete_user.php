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
}elseif($_SESSION['user_type'] === "security")
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

    <title>RESPARKMAN - Delete Employee Account</title>

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
                    Delete User
                </div>
                <div class="input-boxes1">
                    <?php
                    include_once "includes/encdec.inc.php";
                    if(isset($_GET['user_id']))
                    {
                        $user_id = $_GET['user_id'];
                        $allusers = "SELECT * FROM user WHERE user_id='$user_id' ";
                        $allusers_run = mysqli_query($conn, $allusers);

                        if(mysqli_num_rows($allusers_run) > 0)
                        {
                            foreach($allusers_run as $users)
                            $name = openssl_decrypt($users["name"], $method, $key, 0, $users["vi"]);
                            $email = openssl_decrypt($users["email"], $method, $key, 0, $users["vi"]);
                            $plate_num = openssl_decrypt($users["plate_num"], $method, $key, 0, $users["vi"]);
                            $username = openssl_decrypt($users["username"], $method, $key, 0, $users["vi"]);
                            $user_type= openssl_decrypt($users["user_type"], $method, $key, 0, $users["vi"]);
                            {
                                ?>
                                <form action="includes/delete_user.inc.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?=$users['user_id'];?>" readonly>
                                    <input type="hidden" name="email" value="<?=$email;?>"readonly>
                                    <input type="hidden" name="username" value="<?=$username;?>" readonly>
                                    <input type="hidden" name="plate_num" value="<?=$plate_num;?>" readonly>
                                    <div class="input-box1">
                                        <label>Name (FN MI. LN)</label>
                                        <br>
                                        <input type="text" name="name" value="<?=$name;?>" readonly>
                                    </div>
                                    <div class="input-box1">
                                        <label>Role</label>
                                        <br>
                                        <input type="text" name="user_type" value="<?=$user_type;?>" readonly>
                                    </div>                                
                                    <div class="button input-box">
                                        <input type="submit" name="delete_user" value="Delete User">
                                    </div>
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