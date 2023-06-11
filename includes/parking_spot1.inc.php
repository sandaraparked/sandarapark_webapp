<?php
require_once "dbhed.inc.php";

$results_per_page = 6;

$sql='SELECT * FROM parking_spot1';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

if (!$result){
    die("Invalid query: ");
}

$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

$this_page_first_result = ($page-1)*$results_per_page;

$sql='SELECT * FROM parking_spot1 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($conn, $sql);

//update parking
if(isset($_POST['parking_id'])) {
    $user_id = $_SESSION["user_id"];
    $parking_id = $_POST['parking_id'];
    $area = $_POST['area'];
    $spot = $_POST['spot'];
    $availability = $_POST['availability'];

    $update = "UPDATE parking_spot1 SET area = ?, spot = ? , availability = ? WHERE parking_id= ? ";
    $stmt1 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt1, $update)) {
      header("location: ../edit_parking_spot1.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_prepare($stmt1,$update);

    mysqli_stmt_bind_param($stmt1, "sssi", $area, $spot, $availability, $parking_id);
    mysqli_stmt_execute($stmt1);

    $insert = "INSERT INTO digital_footprint (accessed_by, accessed_table, action_done, date_accessed, time_accessed) VALUES (?, ?, ?, CURRENT_DATE, CURRENT_TIME);";
    
    $accessed_table = "parking_spot1";
    $action_done = "edit the information of the parking spot  with parking id# $parking_id";

            $stmt2 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $insert)) {
                header("location: ../edit_parking_spot1.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_prepare($stmt2,$insert);
            mysqli_stmt_bind_param($stmt2, "iss", $user_id, $accessed_table, $action_done);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);

      $_SESSION['message'] = "Parking Space updated successfully"; 
	      header('location: ../reserve_exp1_admin.php');
        exit(0);
} 

//delete parking spot
if(isset($_GET['del_parking']))
{
  $parking_id = $_GET['del_parking'];
  
  
  $del = "DELETE FROM parking_spot1 WHERE parking_id = $parking_id;";
  $del_run = mysqli_query($conn, $del);
  
  if($del_run)
  {
    $_SESSION['message'] = "Parking spot deleted successfully"; 
    header('location: ../parking_spot1.php');
    exit(0);
  } 

}
?>