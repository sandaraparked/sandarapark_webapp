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
elseif($_SESSION['user_type'] === "security")
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "accounting")
{
    header("location:login.php");
    exit();
}


include "navbar_sidebar_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Manage Users</title>

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
                    Employee Management
                </div>
                <?php 
                include('message.php');
                ?>
                <div class="text-right">
                <a href="add_user.php" class="add-btn link-light nounderline" >Add User</a>
                </div>
                <div class="table-responsive">
                    <table class="styled-table">
                        <thread>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thread>
                        <tbody>
                            <?php
                            include('users_processing.php');
                            include "includes/encdec.inc.php";
                            while($row = mysqli_fetch_array($result)){
                                $username = openssl_decrypt($row["username"], $method, $key, 0, $row["vi"]);
                                $name = openssl_decrypt($row["name"], $method, $key, 0, $row["vi"]);
                                $user_type = openssl_decrypt($row["user_type"], $method, $key, 0, $row["vi"]);
                                if ($user_type === "security" OR $user_type === "admin" OR $user_type === "accounting") {
                                ?>
                                <tr>
                                <td><?= $row["user_id"] ?></td>
                                <td><?= $name ?></td>
                                <td><?= $user_type ?></td>
                                <td>
                                    <a href='edit_user.php?user_id=<?= $row["user_id"] ?>' class='edit-btn link-light nounderline'><i class='fas fa-edit'></i></a>
                                    <a href='delete_user.php?user_id=<?= $row["user_id"] ?>' class='del-btn link-light nounderline'><i class='fa fa-trash'></i></a>
                                </td>
                                </tr>
                                <?php
                            }
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
                        echo '<a href="manage_users.php?page=' . $page . '">' . $page . '</a> ';
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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