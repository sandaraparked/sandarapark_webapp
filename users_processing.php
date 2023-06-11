<?php
require_once "includes/dbhed.inc.php";



//Pagination of table
// define how many results you want per page
$results_per_page = 6;

// query/fetches all the rows in the user table
$sql='SELECT * FROM user WHERE user_type != "user";';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

if (!$result){
    die("Invalid query: ");
}

// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
// $sql='SELECT * FROM user WHERE user_type != "user" LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
// $result = mysqli_query($conn, $sql);

$select = 'SELECT * FROM user WHERE user_type != "user" LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$stmt2 = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt2, $select)) {
    header("location: ../login.php?error=stmtfailed");
    exit();
}

mysqli_stmt_execute($stmt2);

$result = mysqli_stmt_get_result($stmt2);


    // include "encdec.inc.php";
    // $rsp = mysqli_fetch_assoc($result_Data);
    // $name = openssl_decrypt($rsp["name"], $method, $key, 0, $rsp["vi"]);
    // $email = openssl_decrypt($rsp["email"], $method, $key, 0, $rsp["vi"]);
    // $plate_num = openssl_decrypt($rsp["plate_num"], $method, $key, 0, $rsp["vi"]);
    // $username = openssl_decrypt($rsp["username"], $method, $key, 0, $rsp["vi"]);
    // $user_type = openssl_decrypt($rsp["user_type"], $method, $key, 0, $rsp["vi"]);

    // $_SESSION["user_id"] = $rsp["user_id"];
    // $_SESSION["name"] = $name;
    // $_SESSION["email"] = $email;
    // $_SESSION["plate_num"] = $plate_num;
    // $_SESSION["username"] = $username;
    // $_SESSION["user_type"] = $user_type;
    // $_SESSION["credit_balance"] = $rsp["credit_balance"];


//update user
/*
if(isset($_POST['update_user'])) {

    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $plate_num = $_POST['plate_num'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $name = $_POST['name'];

    $update = "UPDATE user SET username='$username', password='$password', plate_num='$plate_num', email='$email', user_type='$user_type', name='$name' WHERE user_id=$user_id ";
    $update_run = mysqli_query($conn, $update);

    if($update_run)
    {
      $_SESSION['message'] = " User updated successfully"; 
	      header('location:manage-users.php');
        exit(0);
    } 
} */



//add user
/*if(isset($_POST['add_user']))
{
  $username = mysqli_real_escape_string($data,$_POST['username']);
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];
  $plate_num = mysqli_real_escape_string($data,$_POST['plate_num']);
  $email = mysqli_real_escape_string($data,$_POST['email']);
  $user_type = $_POST['user_type'];
  $name = mysqli_real_escape_string($data,$_POST['name']);

  $select = "SELECT * FROM user WHERE email = '$email' && username ='$username'";
  $result = mysqli_query($data,$select);

  //checking if the user with the same email and username already exist
 if(mysqli_num_rows($result) > 0) {
    $message_e = "user already exist!";
    $_SESSION['addu_message1'] = $message_e;
    header("location:add-user.php");

  }
  else {
    //checks if the password matched
    if($password != $c_password)
        {
            $message_n = "password do not match!";
            $_SESSION['addu_message2'] = $message_n;
            header("location:add-user.php");     
        }
    else {
      //add the user if the email and username does not correspond with an existing user and the password is matched
      $insert = "INSERT INTO user (name, email, username, password, plate_num, user_type)
      VALUES ('$name', '$email', '$username', '$password', '$plate_num', '$user_type') ";
      mysqli_query($data, $insert);
      $_SESSION['message'] = " User added successfully"; 
      header('location:manage-users.php');
    }
  }
}



//delete user
if(isset($_POST['del_user']))
{
  require_once "includes/dbh.inc.php";
  $user_id = $_POST["del_user"];
  //echo gettype($user_id);

  
  //$del = "DELETE FROM user WHERE user_id = $user_id;";
  $del = "DELETE FROM user WHERE `user`.`user_id` = ?;";

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $del)) {
    $_SESSION['message'] = "Invalid query."; 
    header('location: manage-users.php');
    exit(0);
  }

  mysqli_stmt_bind_param($stmt, 's', $user_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

    $_SESSION['message'] = " User deleted successfully"; 
    header('location: manage-users.php');
    exit(0);

}
*/